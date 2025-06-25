<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        // 1. Ambil semua data UMKM dari database HANYA yang statusnya 'approved'.
        // 2. Gunakan 'with()' untuk eager loading, ini membuat query lebih efisien.
        // 3. Gunakan 'latest()' untuk mengurutkan dari yang terbaru.
        // 4. Gunakan 'paginate()' untuk membagi data menjadi beberapa halaman.
        $umkms = Umkm::where('status', 'approved')
                     ->with(['user', 'kategori']) // Mengambil data relasi pemilik dan kategori
                     ->latest()
                     ->paginate(9); // Menampilkan 9 UMKM per halaman

        // Kirim data UMKM ke view 'landing'
        return view('landing', [
            'umkms' => $umkms
        ]);
    }
}