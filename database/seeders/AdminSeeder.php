<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Menggunakan firstOrCreate untuk menghindari duplikasi jika seeder dijalankan lebih dari sekali.
        // Method ini akan mencari user dengan email 'admin@contoh.com',
        // jika tidak ada, maka akan membuat user baru dengan data yang diberikan.
        User::firstOrCreate(
            [
                // Kunci untuk mencari user yang sudah ada
                'email' => 'robbaniehk@gmail.com',
            ],
            [
                // Data yang akan dibuat jika user tidak ditemukan
                'name' => 'Administrator',
                'password' => Hash::make('11223344'), // Ganti 'password' dengan password yang aman
                'role' => 'admin', // Menetapkan role sebagai 'admin'
            ]
        );
    }
}