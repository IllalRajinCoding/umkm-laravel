<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Provinsi;

class KabkotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Nonaktifkan foreign key checks sementara
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Kosongkan tabel tanpa reset auto-increment
        DB::table('kabkota')->delete();

        // Ambil data provinsi untuk mapping
        $provinsiIds = Provinsi::pluck('id', 'nama')->toArray();

        // Data kabupaten/kota
        $kabkota = [
            // DKI Jakarta
            ['nama' => 'Jakarta Pusat', 'latitude' => -6.1862, 'longitude' => 106.8345, 'provinsi_nama' => 'DKI Jakarta'],
            ['nama' => 'Jakarta Utara', 'latitude' => -6.1384, 'longitude' => 106.8638, 'provinsi_nama' => 'DKI Jakarta'],
            ['nama' => 'Jakarta Barat', 'latitude' => -6.1678, 'longitude' => 106.7639, 'provinsi_nama' => 'DKI Jakarta'],
            ['nama' => 'Jakarta Selatan', 'latitude' => -6.2624, 'longitude' => 106.8106, 'provinsi_nama' => 'DKI Jakarta'],
            ['nama' => 'Jakarta Timur', 'latitude' => -6.2445, 'longitude' => 106.8939, 'provinsi_nama' => 'DKI Jakarta'],
            ['nama' => 'Kepulauan Seribu', 'latitude' => -5.6000, 'longitude' => 106.5833, 'provinsi_nama' => 'DKI Jakarta'],

            // Jawa Barat
            ['nama' => 'Bandung', 'latitude' => -6.9175, 'longitude' => 107.6191, 'provinsi_nama' => 'Jawa Barat'],
            ['nama' => 'Bogor', 'latitude' => -6.5950, 'longitude' => 106.8063, 'provinsi_nama' => 'Jawa Barat'],
            ['nama' => 'Bekasi', 'latitude' => -6.2383, 'longitude' => 106.9756, 'provinsi_nama' => 'Jawa Barat'],
            ['nama' => 'Depok', 'latitude' => -6.4025, 'longitude' => 106.7942, 'provinsi_nama' => 'Jawa Barat'],
            ['nama' => 'Cimahi', 'latitude' => -6.8722, 'longitude' => 107.5425, 'provinsi_nama' => 'Jawa Barat'],
            ['nama' => 'Tasikmalaya', 'latitude' => -7.3506, 'longitude' => 108.2170, 'provinsi_nama' => 'Jawa Barat'],
            ['nama' => 'Cirebon', 'latitude' => -6.7320, 'longitude' => 108.5523, 'provinsi_nama' => 'Jawa Barat'],
            ['nama' => 'Karawang', 'latitude' => -6.3227, 'longitude' => 107.3376, 'provinsi_nama' => 'Jawa Barat'],

            // Jawa Tengah
            ['nama' => 'Semarang', 'latitude' => -6.9667, 'longitude' => 110.4167, 'provinsi_nama' => 'Jawa Tengah'],
            ['nama' => 'Surakarta', 'latitude' => -7.5561, 'longitude' => 110.8318, 'provinsi_nama' => 'Jawa Tengah'],
            ['nama' => 'Magelang', 'latitude' => -7.4706, 'longitude' => 110.2178, 'provinsi_nama' => 'Jawa Tengah'],
            ['nama' => 'Pekalongan', 'latitude' => -6.8883, 'longitude' => 109.6753, 'provinsi_nama' => 'Jawa Tengah'],
            ['nama' => 'Tegal', 'latitude' => -6.8797, 'longitude' => 109.1256, 'provinsi_nama' => 'Jawa Tengah'],

            // Bali
            ['nama' => 'Denpasar', 'latitude' => -8.6705, 'longitude' => 115.2126, 'provinsi_nama' => 'Bali'],
            ['nama' => 'Badung', 'latitude' => -8.5922, 'longitude' => 115.1741, 'provinsi_nama' => 'Bali'],
            ['nama' => 'Gianyar', 'latitude' => -8.4239, 'longitude' => 115.2778, 'provinsi_nama' => 'Bali'],
            ['nama' => 'Buleleng', 'latitude' => -8.2132, 'longitude' => 114.9566, 'provinsi_nama' => 'Bali'],
        ];

        // Insert data ke database
        foreach ($kabkota as $data) {
            if (isset($provinsiIds[$data['provinsi_nama']])) {
                DB::table('kabkota')->insert([
                    'nama' => $data['nama'],
                    'latitude' => $data['latitude'],
                    'longitude' => $data['longitude'],
                    'provinsi_id' => $provinsiIds[$data['provinsi_nama']]
                ]);
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}