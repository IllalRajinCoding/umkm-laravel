<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
// Model 'KategoriUmkm' tidak perlu di-import jika kita menggunakan DB::table()
// use App\Models\KategoriUmkm;

class KategoriUmkmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Kosongkan tabel untuk menghindari data duplikat saat seeding ulang
        DB::table('kategori_umkm')->truncate();

        $kategori = [
            ['nama' => 'Kuliner'],
            ['nama' => 'Fashion'],
            ['nama' => 'Kerajinan Tangan (Handicraft)'],
            ['nama' => 'Agribisnis'],
            ['nama' => 'Jasa'],
            ['nama' => 'Pendidikan'],
            ['nama' => 'Teknologi Informasi & Digital'],
            ['nama' => 'Kecantikan & Kesehatan'],
            ['nama' => 'Otomotif'],
            ['nama' => 'Ekonomi Kreatif Lainnya'],
        ];


        DB::table('kategori_umkm')->insert($kategori);
    }
}