<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Provinsi;
use Illuminate\Support\Facades\DB;

class ProvinsiSeeder extends Seeder
{
    public function run()
    {
        // Nonaktifkan foreign key checks sementara
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Kosongkan tabel tanpa reset auto-increment
        DB::table('provinsi')->delete();

        // Data provinsi Indonesia
        $provinsi = [
            ['nama' => 'Aceh', 'ibukota' => 'Banda Aceh', 'latitude' => 5.5483, 'longitude' => 95.3238],
            ['nama' => 'Sumatera Utara', 'ibukota' => 'Medan', 'latitude' => 3.5952, 'longitude' => 98.6722],
            ['nama' => 'Sumatera Barat', 'ibukota' => 'Padang', 'latitude' => -0.9471, 'longitude' => 100.4176],
            ['nama' => 'Riau', 'ibukota' => 'Pekanbaru', 'latitude' => 0.5071, 'longitude' => 101.4478],
            ['nama' => 'Jambi', 'ibukota' => 'Jambi', 'latitude' => -1.6101, 'longitude' => 103.6131],
            ['nama' => 'Sumatera Selatan', 'ibukota' => 'Palembang', 'latitude' => -2.9761, 'longitude' => 104.7754],
            ['nama' => 'Bengkulu', 'ibukota' => 'Bengkulu', 'latitude' => -3.7928, 'longitude' => 102.2607],
            ['nama' => 'Lampung', 'ibukota' => 'Bandar Lampung', 'latitude' => -5.3971, 'longitude' => 105.2660],
            ['nama' => 'Bangka Belitung', 'ibukota' => 'Pangkal Pinang', 'latitude' => -2.1276, 'longitude' => 106.1157],
            ['nama' => 'Kepulauan Riau', 'ibukota' => 'Tanjung Pinang', 'latitude' => 0.9185, 'longitude' => 104.4554],
            ['nama' => 'DKI Jakarta', 'ibukota' => 'Jakarta', 'latitude' => -6.2088, 'longitude' => 106.8456],
            ['nama' => 'Jawa Barat', 'ibukota' => 'Bandung', 'latitude' => -6.9147, 'longitude' => 107.6098],
            ['nama' => 'Jawa Tengah', 'ibukota' => 'Semarang', 'latitude' => -6.9667, 'longitude' => 110.4167],
            ['nama' => 'DI Yogyakarta', 'ibukota' => 'Yogyakarta', 'latitude' => -7.7956, 'longitude' => 110.3695],
            ['nama' => 'Jawa Timur', 'ibukota' => 'Surabaya', 'latitude' => -7.2575, 'longitude' => 112.7521],
            ['nama' => 'Banten', 'ibukota' => 'Serang', 'latitude' => -6.1200, 'longitude' => 106.1503],
            ['nama' => 'Bali', 'ibukota' => 'Denpasar', 'latitude' => -8.6705, 'longitude' => 115.2126],
            ['nama' => 'Nusa Tenggara Barat', 'ibukota' => 'Mataram', 'latitude' => -8.5833, 'longitude' => 116.1167],
            ['nama' => 'Nusa Tenggara Timur', 'ibukota' => 'Kupang', 'latitude' => -10.1772, 'longitude' => 123.6070],
            ['nama' => 'Kalimantan Barat', 'ibukota' => 'Pontianak', 'latitude' => -0.0263, 'longitude' => 109.3425],
            ['nama' => 'Kalimantan Tengah', 'ibukota' => 'Palangkaraya', 'latitude' => -2.2100, 'longitude' => 113.9200],
            ['nama' => 'Kalimantan Selatan', 'ibukota' => 'Banjar Masin', 'latitude' => -3.3167, 'longitude' => 114.5833],
            ['nama' => 'Kalimantan Timur', 'ibukota' => 'Samarinda', 'latitude' => -0.5022, 'longitude' => 117.1536],
            ['nama' => 'Kalimantan Utara', 'ibukota' => 'Tanjung Selor', 'latitude' => 2.8375, 'longitude' => 117.3653],
            ['nama' => 'Sulawesi Utara', 'ibukota' => 'Manado', 'latitude' => 1.4931, 'longitude' => 124.8413],
            ['nama' => 'Sulawesi Tengah', 'ibukota' => 'Palu', 'latitude' => -0.9000, 'longitude' => 119.8333],
            ['nama' => 'Sulawesi Selatan', 'ibukota' => 'Makassar', 'latitude' => -5.1477, 'longitude' => 119.4327],
            ['nama' => 'Sulawesi Tenggara', 'ibukota' => 'Kendari', 'latitude' => -3.9678, 'longitude' => 122.5947],
            ['nama' => 'Gorontalo', 'ibukota' => 'Gorontalo', 'latitude' => 0.5333, 'longitude' => 123.0667],
            ['nama' => 'Sulawesi Barat', 'ibukota' => 'Mamuju', 'latitude' => -2.6786, 'longitude' => 118.8933],
            ['nama' => 'Maluku', 'ibukota' => 'Ambon', 'latitude' => -3.6561, 'longitude' => 128.1664],
            ['nama' => 'Maluku Utara', 'ibukota' => 'Ternate', 'latitude' => 0.7833, 'longitude' => 127.3667],
            ['nama' => 'Papua Barat', 'ibukota' => 'Manokwari', 'latitude' => -0.8667, 'longitude' => 134.0833],
            ['nama' => 'Papua', 'ibukota' => 'Jayapura', 'latitude' => -2.5333, 'longitude' => 140.7167],
        ];

        // Insert data tanpa timestamp
        DB::table('provinsi')->insert($provinsi);

        // Aktifkan kembali foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
