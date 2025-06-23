<?php
namespace App\Livewire\Umkm;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Umkm;
use App\Models\KategoriUmkm;
use App\Models\Kabkota;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action; // Fix import untuk Action
use App\Filament\Resources\UmkmResource;

#[Layout('layouts.app')]
class Pendaftaran extends Component
{
    public $nama = '';
    public $kategori_umkm_id = '';
    public $kabkota_id = '';
    public $alamat = '';
    public $modal = '';
    public $website = '';
    public $email = '';

    /**
     * Custom validation messages
     */
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
    ];

    /**
     * Aturan validasi untuk setiap properti/input form.
     */
    protected $rules = [
        'nama' => 'required|string|max:100',
        'kategori_umkm_id' => 'required|exists:kategori_umkm,id',
        'kabkota_id' => 'required|exists:kabkota,id',
        'alamat' => 'required|string|max:255',
        'modal' => 'nullable|numeric|min:0',
        'website' => 'nullable|url|max:45',
        'email' => 'nullable|email|max:45',
    ];

    /**
     * Real-time validation saat user mengetik
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     * Reset form setelah berhasil submit
     */
    public function resetForm()
    {
        $this->reset(['nama', 'kategori_umkm_id', 'kabkota_id', 'alamat', 'modal', 'website', 'email']);
        $this->resetErrorBag();
    }

    /**
     * Fungsi ini dieksekusi saat tombol 'Daftarkan' ditekan.
     */
    public function save()
    {
        try {
            $validatedData = $this->validate();

            // Cek apakah user sudah memiliki UMKM pending
            $existingPendingUmkm = Umkm::where('user_id', Auth::id())
                ->where('status', 'pending')
                ->exists();

            if ($existingPendingUmkm) {
                session()->flash('error', 'Anda masih memiliki pendaftaran UMKM yang menunggu persetujuan.');
                return;
            }

            // Tambahkan data user dan status
            $validatedData['user_id'] = Auth::id();
            $validatedData['status'] = 'pending';

            // Convert modal ke float jika ada
            if (!empty($validatedData['modal'])) {
                $validatedData['modal'] = (float) $validatedData['modal'];
            }

            // Buat UMKM baru
            $umkm = Umkm::create($validatedData);
            
            // Kirim notifikasi ke admin
            $this->sendNotificationToAdmins($umkm);

            $this->resetForm();
            session()->flash('success', 'UMKM berhasil didaftarkan dan sedang menunggu persetujuan.');

            return redirect()->route('umkm.user'); // Redirect ke halaman UMKM user

        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat mendaftarkan UMKM. Silakan coba lagi.');
        }
    }

    /**
     * Kirim notifikasi ke semua admin
     */
    private function sendNotificationToAdmins($umkm)
    {
        $admins = User::where('role', 'admin')->get();
        $owner = Auth::user();

        foreach ($admins as $admin) {
            Notification::make()
                ->title('Pendaftaran UMKM Baru!')
                ->body("UMKM '{$umkm->nama}' oleh {$owner->name} menunggu persetujuan.")
                ->warning()
                ->actions([
                    Action::make('view')
                        ->label('Lihat & Setujui')
                        ->url(UmkmResource::getUrl('edit', ['record' => $umkm->id]))
                        ->markAsRead(),
                ])
                ->sendToDatabase($admin);
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