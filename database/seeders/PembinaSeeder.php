<?php

namespace Database\Seeders;

use App\Models\Pembina;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing records to avoid duplicates
        DB::table('pembina')->truncate();

        $faker = Faker::create('id_ID'); // Using Indonesian locale

        // List of expertise areas for UMKM mentors
        $keahlian = [
            'Manajemen Keuangan',
            'Pemasaran Digital',
            'Pengembangan Produk',
            'Strategi Bisnis',
            'Ekspor Impor',
            'E-commerce',
            'Branding',
            'Manajemen Operasional',
            'Digital Marketing',
            'Manajemen SDM',
            'Hukum Bisnis',
            'Perpajakan',
            'Akuntansi UMKM',
            'Pengembangan Pasar',
            'Pengemasan Produk',
            'Regulasi UMKM',
            'Teknologi Informasi',
            'Produksi Berkelanjutan',
            'Manajemen Rantai Pasok',
            'Ekspansi Bisnis'
        ];

        // Indonesian cities for birthplace
        $cities = [
            'Jakarta',
            'Surabaya',
            'Bandung',
            'Medan',
            'Semarang',
            'Makassar',
            'Palembang',
            'Yogyakarta',
            'Denpasar',
            'Malang',
            'Padang',
            'Manado',
            'Balikpapan',
            'Pontianak',
            'Banjarmasin',
            'Pekanbaru',
            'Samarinda',
            'Tasikmalaya',
            'Kupang',
            'Jambi',
            'Mataram',
            'Bengkulu',
            'Kendari',
            'Palu',
            'Ambon'
        ];

        // Create 5 sample pembina records
        for ($i = 0; $i < 5; $i++) {
            // Randomly select 1-3 areas of expertise
            $expertiseCount = rand(1, 3);
            $selectedExpertise = $faker->randomElements($keahlian, $expertiseCount);
            $expertiseString = implode(', ', $selectedExpertise);

            // 60% male, 40% female distribution
            $gender = $faker->randomElement(['L', 'L', 'L', 'P', 'P']);

            // Create the pembina record
            Pembina::create([
                'nama' => $faker->name($gender == 'L' ? 'male' : 'female'),
                'gender' => $gender,
                'tgl_lahir' => $faker->dateTimeBetween('-60 years', '-30 years')->format('Y-m-d'),
                'tmp_lahir' => $faker->randomElement($cities),
                'keahlian' => $expertiseString,
            ]);
        }

        // Add 5 specific/named mentors
        $specificMentors = [
            [
                'nama' => 'Dr. Hendra Wijaya',
                'gender' => 'L',
                'tgl_lahir' => '1975-03-15',
                'tmp_lahir' => 'Jakarta',
                'keahlian' => 'Strategi Bisnis, Pengembangan Pasar, Ekspor Impor',
            ],
            [
                'nama' => 'Ir. Ratna Dewi, M.M.',
                'gender' => 'P',
                'tgl_lahir' => '1980-08-22',
                'tmp_lahir' => 'Surabaya',
                'keahlian' => 'Manajemen Keuangan, Akuntansi UMKM',
            ],
            [
                'nama' => 'Ahmad Faisal, S.E.',
                'gender' => 'L',
                'tgl_lahir' => '1982-05-10',
                'tmp_lahir' => 'Bandung',
                'keahlian' => 'Digital Marketing, E-commerce, Branding',
            ],
            [
                'nama' => 'Sri Wahyuni, S.H.',
                'gender' => 'P',
                'tgl_lahir' => '1978-12-03',
                'tmp_lahir' => 'Yogyakarta',
                'keahlian' => 'Hukum Bisnis, Regulasi UMKM, Perpajakan',
            ],
            [
                'nama' => 'Budi Santoso, M.T.',
                'gender' => 'L',
                'tgl_lahir' => '1976-09-18',
                'tmp_lahir' => 'Semarang',
                'keahlian' => 'Teknologi Informasi, E-commerce',
            ],
        ];

        foreach ($specificMentors as $mentor) {
            Pembina::create($mentor);
        }

        $this->command->info('Successfully inserted 10 pembina records');
    }
}
