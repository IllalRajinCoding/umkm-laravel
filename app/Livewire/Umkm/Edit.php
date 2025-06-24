<?php

namespace App\Livewire\Umkm;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Umkm;
use App\Models\KategoriUmkm;
use App\Models\Kabkota;
use App\Models\Pembina;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
class Edit extends Component
{
    use WithFileUploads;

    public $umkm;
    public $nama = '';
    public $kategori_umkm_id = '';
    public $kabkota_id = '';
    public $alamat = '';
    public $modal = '';
    public $website = '';
    public $email = '';
    public $gambar;
    public $existing_gambar = '';

    protected $messages = [
        'nama.required' => 'Nama UMKM wajib diisi.',
        'nama.max' => 'Nama UMKM maksimal 100 karakter.',
        'kategori_umkm_id.required' => 'Kategori UMKM wajib dipilih.',
        'kategori_umkm_id.exists' => 'Kategori UMKM yang dipilih tidak valid.',
        'kabkota_id.required' => 'Kabupaten/Kota wajib dipilih.',
        'kabkota_id.exists' => 'Kabupaten/Kota yang dipilih tidak valid.',
        'alamat.required' => 'Alamat wajib diisi.',
        'alamat.max' => 'Alamat maksimal 255 karakter.',
        'modal.numeric' => 'Modal harus berupa angka.',
        'website.url' => 'Format website tidak valid.',
        'website.max' => 'Website maksimal 45 karakter.',
        'email.email' => 'Format email tidak valid.',
        'email.max' => 'Email maksimal 45 karakter.',
        'gambar.image' => 'File harus berupa gambar.',
        'gambar.max' => 'Ukuran file maksimal 10MB.',
    ];

    protected $rules = [
        'nama' => 'required|string|max:100',
        'kategori_umkm_id' => 'required|exists:kategori_umkm,id',
        'kabkota_id' => 'required|exists:kabkota,id',
        'alamat' => 'required|string|max:255',
        'modal' => 'nullable|numeric|min:0',
        'website' => 'nullable|url|max:45',
        'email' => 'nullable|email|max:45',
        'gambar' => 'nullable|image|max:10240',
    ];

    public function mount($id)
    {
        $this->umkm = Umkm::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();


        // Populate form fields
        $this->nama = $this->umkm->nama;
        $this->kategori_umkm_id = $this->umkm->kategori_umkm_id;
        $this->kabkota_id = $this->umkm->kabkota_id;
        $this->alamat = $this->umkm->alamat;
        $this->modal = $this->umkm->modal;
        $this->website = $this->umkm->website;
        $this->email = $this->umkm->email;
        $this->existing_gambar = $this->umkm->gambar; // Set existing image
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function removeExistingImage()
    {
        $this->existing_gambar = '';
    }

    public function save()
    {
        try {
            // Validate data
            $validatedData = $this->validate();

            // Handle file upload
            if ($this->gambar) {
                // Delete old image if exists
                if ($this->umkm->gambar) {
                    Storage::disk('public')->delete($this->umkm->gambar);
                }
                $gambarPath = $this->gambar->store('umkm-images', 'public');
                $validatedData['gambar'] = $gambarPath;
            } elseif (empty($this->existing_gambar)) {
                // If existing image was removed and no new image uploaded
                if ($this->umkm->gambar) {
                    Storage::disk('public')->delete($this->umkm->gambar);
                }
                $validatedData['gambar'] = null;
            } else {
                // Keep existing image
                unset($validatedData['gambar']);
            }

            // Convert modal to float if exists
            if (!empty($validatedData['modal'])) {
                $validatedData['modal'] = (float) $validatedData['modal'];
            }

            // Update UMKM
            $this->umkm->update($validatedData);

            Log::info('UMKM updated successfully', ['umkm_id' => $this->umkm->id]);

            // Set session flash message
            session()->flash('success', 'Data UMKM berhasil diperbarui.');

            // Redirect to dashboard
            return $this->redirectRoute('dashboard');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Re-throw validation exceptions so they show in the form
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error updating UMKM: ' . $e->getMessage(), [
                'exception' => $e,
                'umkm_id' => $this->umkm->id,
                'user_id' => Auth::id()
            ]);
            $this->addError('general', 'Terjadi kesalahan saat memperbarui UMKM. Silakan coba lagi.');
        }
    }

    public function render()
    {
        return view('livewire.umkm.edit', [
            'kategori_list' => KategoriUmkm::orderBy('nama')->get(),
            'kabkota_list' => Kabkota::orderBy('nama')->get(),
        ]);
    }
}
