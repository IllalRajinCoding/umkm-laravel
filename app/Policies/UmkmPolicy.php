<?php

namespace App\Policies;

use App\Models\Umkm;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class UmkmPolicy
{
    /**
     * Aturan untuk admin: Beri akses penuh ke semua aksi.
     * Metode ini akan dijalankan SEBELUM metode lainnya.
     * Jika ini mengembalikan true, pemeriksaan lain tidak akan dilakukan.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->role === 'admin') {
            return true;
        }

        return null; // Lanjutkan ke pemeriksaan aturan lain jika bukan admin
    }

    /**
     * Tentukan apakah pengguna dapat melihat daftar UMKM.
     * User hanya bisa melihat UMKM miliknya sendiri
     */
    public function viewAny(User $user): bool
    {
        return true; // User yang login bisa melihat daftar UMKM
    }

    /**
     * Tentukan apakah pengguna dapat melihat detail satu UMKM.
     * User hanya bisa melihat detail UMKM miliknya sendiri atau UMKM yang public
     */
    public function view(User $user, Umkm $umkm): bool
    {
        // User bisa melihat UMKM miliknya sendiri atau jika UMKM sudah approved (public)
        return $user->id === $umkm->user_id || $umkm->status === 'approved';
    }

    /**
     * Tentukan apakah pengguna dapat membuat UMKM baru.
     * Semua pengguna yang terdaftar boleh membuat UMKM
     */
    public function create(User $user): bool
    {
        return true; // User yang login bisa membuat UMKM
    }

    /**
     * Tentukan apakah pengguna dapat mengedit (update) sebuah UMKM.
     * INI ATURAN YANG PALING PENTING.
     */
    public function update(User $user, Umkm $umkm): bool
    {
        // Pengguna boleh mengedit HANYA JIKA:
        // 1. Dia adalah pemilik UMKM tersebut
        // 2. UMKM masih dalam status 'pending' atau 'draft' (tidak bisa edit jika sudah approved kecuali admin)
        return $this->isOwner($user, $umkm) &&
            in_array($umkm->status, ['pending', 'draft']);
    }

    /**
     * Tentukan apakah pengguna dapat menghapus sebuah UMKM.
     * Logikanya sama dengan update tapi lebih ketat
     */
    public function delete(User $user, Umkm $umkm): bool
    {
        // Pengguna boleh menghapus HANYA JIKA:
        // 1. Dia adalah pemilik UMKM tersebut
        // 2. UMKM belum disetujui (status pending atau draft)
        return $this->isOwner($user, $umkm) &&
            in_array($umkm->status, ['pending', 'draft', 'rejected']);
    }

    /**
     * Tentukan apakah pengguna dapat merestore UMKM yang sudah dihapus
     */
    public function restore(User $user, Umkm $umkm): bool
    {
        // Hanya pemilik yang bisa restore
        return $this->isOwner($user, $umkm);
    }

    /**
     * Tentukan apakah pengguna dapat menghapus permanen sebuah UMKM
     */
    public function forceDelete(User $user, Umkm $umkm): bool
    {
        // Hanya pemilik yang bisa force delete, dan hanya jika status draft
        return $this->isOwner($user, $umkm) && $umkm->status === 'draft';
    }

    /**
     * Tentukan apakah pengguna dapat mengubah status UMKM (approve/reject)
     * Hanya admin yang bisa mengubah status
     */
    public function changeStatus(User $user, Umkm $umkm): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Tentukan apakah pengguna dapat melihat statistik UMKM
     * User hanya bisa melihat statistik UMKM miliknya sendiri
     */
    public function viewStatistics(User $user, Umkm $umkm): bool
    {
        return $this->isOwner($user, $umkm);
    }

    /**
     * Tentukan apakah pengguna dapat mengeksport data UMKM
     * User hanya bisa export data UMKM miliknya sendiri
     */
    public function export(User $user, Umkm $umkm): bool
    {
        return $this->isOwner($user, $umkm);
    }

    /**
     * Tentukan apakah pengguna dapat mengedit informasi tambahan UMKM
     * (seperti foto, dokumen, dll)
     */
    public function updateAssets(User $user, Umkm $umkm): bool
    {
        // Pemilik bisa update assets kapan saja (bahkan setelah approved)
        return $this->isOwner($user, $umkm);
    }

    /**
     * Tentukan apakah pengguna dapat melihat history/log perubahan UMKM
     */
    public function viewHistory(User $user, Umkm $umkm): bool
    {
        return $this->isOwner($user, $umkm);
    }

    /**
     * Tentukan apakah pengguna dapat mengubah data sensitif UMKM
     * (seperti kategori, lokasi, dll yang memerlukan re-approval)
     */
    public function updateSensitiveData(User $user, Umkm $umkm): bool
    {
        // Hanya bisa update data sensitif jika status masih pending/draft
        return $this->isOwner($user, $umkm) &&
            in_array($umkm->status, ['pending', 'draft']);
    }

    /**
     * Tentukan apakah pengguna dapat submit UMKM untuk review
     */
    public function submitForReview(User $user, Umkm $umkm): bool
    {
        // Pemilik bisa submit jika status masih draft
        return $this->isOwner($user, $umkm) && $umkm->status === 'draft';
    }

    /**
     * Tentukan apakah pengguna dapat membatalkan submission
     */
    public function cancelSubmission(User $user, Umkm $umkm): bool
    {
        // Pemilik bisa cancel jika status pending (belum di-review admin)
        return $this->isOwner($user, $umkm) && $umkm->status === 'pending';
    }

    /**
     * Tentukan apakah pengguna dapat duplicate/clone UMKM
     */
    public function duplicate(User $user, Umkm $umkm): bool
    {
        // Pemilik bisa duplicate UMKM yang sudah approved
        return $this->isOwner($user, $umkm) && $umkm->status === 'approved';
    }

    /**
     * Tentukan apakah pengguna dapat publish/unpublish UMKM
     */
    public function togglePublish(User $user, Umkm $umkm): bool
    {
        // Pemilik bisa toggle publish untuk UMKM yang sudah approved
        return $this->isOwner($user, $umkm) && $umkm->status === 'approved';
    }

    /**
     * Helper method untuk mengecek ownership
     * 
     * @param User $user
     * @param Umkm $umkm
     * @return bool
     */
    private function isOwner(User $user, Umkm $umkm): bool
    {
        return $user->id === $umkm->user_id;
    }

    /**
     * Helper method untuk mengecek status yang bisa diedit
     * 
     * @param string $status
     * @return bool
     */
    private function isEditableStatus(string $status): bool
    {
        return in_array($status, ['pending', 'draft']);
    }

    /**
     * Helper method untuk mengecek status yang bisa dihapus
     * 
     * @param string $status
     * @return bool
     */
    private function isDeletableStatus(string $status): bool
    {
        return in_array($status, ['pending', 'draft', 'rejected']);
    }
}
