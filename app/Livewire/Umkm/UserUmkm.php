<?php

namespace App\Livewire\Umkm;

use App\Models\Umkm;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class UserUmkm extends Component
{
    public function render()
    {
        $umkms = Umkm::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('livewire.umkm.user-umkm', [
            'umkms' => $umkms,
        ]);
    }

    public function delete($umkmId)
    {
        // 1. Temukan data UMKM yang ingin dihapus
        $umkm = Umkm::findOrFail($umkmId);

        // 2. Lakukan Pengecekan Otorisasi!
        //    Perintah ini akan secara otomatis memanggil metode 'delete' di UmkmPolicy.
        //    Jika aturan mengizinkan (return true), kode akan lanjut.
        //    Jika tidak (return false), Laravel akan otomatis menampilkan halaman error "403 Forbidden".
        $this->authorize('delete', $umkm);

        // 3. Jika diizinkan, baru hapus data
        $umkm->delete();

        // Beri pesan sukses
        session()->flash('success', 'UMKM berhasil dihapus.');
    }
}
