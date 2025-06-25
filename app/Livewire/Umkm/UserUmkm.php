<?php

namespace App\Livewire\Umkm;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Umkm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

#[Layout('layouts.app')]
class UserUmkm extends Component
{
    public $showDeleteModal = false;
    public $umkmToDelete = null;

    public function edit($umkmId)
    {
        $umkm = Umkm::where('id', $umkmId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$umkm) {
            session()->flash('error', 'UMKM tidak ditemukan atau Anda tidak memiliki akses.');
            return;
        }

        // Debug log
        Log::info('Redirecting to edit UMKM: ' . $umkm->id);

        // Redirect ke halaman edit
        return $this->redirect(route('umkm.edit', $umkm->id), navigate: true);
    }

    public function confirmDelete($umkmId)
    {
        $this->umkmToDelete = Umkm::where('id', $umkmId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$this->umkmToDelete) {
            session()->flash('error', 'UMKM tidak ditemukan atau Anda tidak memiliki akses.');
            return;
        }

        $this->showDeleteModal = true;
    }

    public function delete()
    {
        if (!$this->umkmToDelete) {
            $this->showDeleteModal = false;
            return;
        }

        try {
            // Hapus file gambar jika ada
            if ($this->umkmToDelete->gambar) {
                Storage::disk('public')->delete($this->umkmToDelete->gambar);
            }

            // Hapus UMKM
            $this->umkmToDelete->delete();

            session()->flash('success', 'UMKM berhasil dihapus.');
            
            $this->showDeleteModal = false;
            $this->umkmToDelete = null;

        } catch (\Exception $e) {
            Log::error('Error deleting UMKM: ' . $e->getMessage());
            session()->flash('error', 'Terjadi kesalahan saat menghapus UMKM.');
        }
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->umkmToDelete = null;
    }

    public function render()
    {
        $umkms = Umkm::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.umkm.user-umkm', compact('umkms'));
    }
}