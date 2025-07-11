<?php

namespace App\Livewire\Umkm;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Umkm;
use App\Models\KategoriUmkm;
use App\Models\Kabkota;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;
use App\Models\Pembina;

#[Layout('layouts.app')]
class Pendaftaran extends Component
{
    use WithFileUploads;

    public $nama = '';
    public $kategori_umkm_id = '';
    public $kabkota_id = '';
    public $alamat = '';
    public $modal = '';
    public $website = '';
    public $email = '';
    public $gambar;

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
        'gambar' => 'nullable|image|max:10240'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function resetForm()
    {
        $this->reset(['nama', 'kategori_umkm_id', 'kabkota_id', 'alamat', 'modal', 'website', 'email', 'gambar']);
        $this->resetErrorBag();
    }

    public function save()
    {
        try {
            // Validate data
            $validatedData = $this->validate();

            // Check for existing pending UMKM
            $existingPendingUmkm = Umkm::where('user_id', Auth::id())
                ->where('status', 'pending')
                ->exists();

            if ($existingPendingUmkm) {
                $this->addError('general', 'Anda masih memiliki pendaftaran UMKM yang menunggu persetujuan.');
                return;
            }

            // Handle file upload
            if ($this->gambar) {
                $gambarPath = $this->gambar->store('umkm-images', 'public');
                $validatedData['gambar'] = $gambarPath;
            }

            // Add user and status
            $validatedData['user_id'] = Auth::id();
            $validatedData['status'] = 'pending';

            // Convert modal to float if exists
            if (!empty($validatedData['modal'])) {
                $validatedData['modal'] = (float) $validatedData['modal'];
            }

            // Create UMKM
            $umkm = Umkm::create($validatedData);

            Log::info('UMKM created successfully', ['umkm_id' => $umkm->id]);

            // Set session flash message
            session()->flash('success', 'UMKM berhasil didaftarkan dan sedang menunggu persetujuan.');

            // Use JavaScript redirect as fallback
            $this->dispatch('redirect-to-dashboard');

            // Also try Livewire redirect
            return $this->redirectRoute('dashboard');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Re-throw validation exceptions so they show in the form
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error creating UMKM: ' . $e->getMessage(), [
                'exception' => $e,
                'user_id' => Auth::id()
            ]);
            $this->addError('general', 'Terjadi kesalahan saat mendaftarkan UMKM. Silakan coba lagi.');
        }
    }

    public function render()
    {
        return view('livewire.umkm.pendaftaran', [
            'kategori_list' => KategoriUmkm::orderBy('nama')->get(),
            'kabkota_list' => Kabkota::orderBy('nama')->get(),
        ]);
    }
}
