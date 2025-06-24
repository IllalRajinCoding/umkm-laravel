<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembina;

class PembinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Mendefinisikan data pembina secara langsung dalam sebuah array
        $dataPembina = [
            [
                'nama'      => 'Dr. Budi Santoso',
                'gender'    => 'Laki-laki',
                'tgl_lahir' => '1985-05-15',
                'tmp_lahir' => 'Jakarta',
                'keahlian'  => 'Manajemen Keuangan',
            ],
            [
                'nama'      => 'Citra Lestari, M.Kom.',
                'gender'    => 'Perempuan',
                'tgl_lahir' => '1990-08-22',
                'tmp_lahir' => 'Bandung',
                'keahlian'  => 'Pemasaran Digital',
            ],
            [
                'nama'      => 'Ahmad Wijaya',
                'gender'    => 'Laki-laki',
                'tgl_lahir' => '1982-11-30',
                'tmp_lahir' => 'Surabaya',
                'keahlian'  => 'Strategi Bisnis',
            ],
            [
                'nama'      => 'Dewi Anggraini, S.Ds.',
                'gender'    => 'Perempuan',
                'tgl_lahir' => '1992-02-10',
                'tmp_lahir' => 'Yogyakarta',
                'keahlian'  => 'Desain Produk',
            ],
            [
                'nama'      => 'Rian Hidayat',
                'gender'    => 'Laki-laki',
                'tgl_lahir' => '1988-07-19',
                'tmp_lahir' => 'Medan',
                'keahlian'  => 'Fotografi Produk',
            ],
            [
                'nama'      => 'Siti Nurhaliza, S.H.',
                'gender'    => 'Perempuan',
                'tgl_lahir' => '1989-09-05',
                'tmp_lahir' => 'Makassar',
                'keahlian'  => 'Legalitas Usaha',
            ],
            [
                'nama'      => 'Eko Prasetyo',
                'gender'    => 'Laki-laki',
                'tgl_lahir' => '1979-12-25',
                'tmp_lahir' => 'Semarang',
                'keahlian'  => 'Manajemen SDM',
            ],
            [
                'nama'      => 'Fitria Rahmawati',
                'gender'    => 'Perempuan',
                'tgl_lahir' => '1991-04-14',
                'tmp_lahir' => 'Palembang',
                'keahlian'  => 'Copywriting',
            ],
            [
                'nama'      => 'Agus Setiawan',
                'gender'    => 'Laki-laki',
                'tgl_lahir' => '1986-06-01',
                'tmp_lahir' => 'Bogor',
                'keahlian'  => 'Pemasaran Digital',
            ],
            [
                'nama'      => 'Lina Marlina',
                'gender'    => 'Perempuan',
                'tgl_lahir' => '1993-10-08',
                'tmp_lahir' => 'Sukabumi',
                'keahlian'  => 'Manajemen Keuangan',
            ],
        ];

        // Memasukkan semua data dari array ke dalam tabel 'pembina' sekaligus.
        // Method insert() lebih efisien untuk data dalam jumlah besar dan tidak memicu Eloquent events.
        Pembina::insert($dataPembina);
    }
}
