# UMKM Management System

## Overview

UMKM Management System adalah aplikasi berbasis web yang dirancang untuk memudahkan pengelolaan dan pendaftaran Usaha Mikro, Kecil, dan Menengah (UMKM) di Indonesia. Aplikasi ini menyediakan platform bagi pengguna untuk mendaftarkan UMKM mereka, mengelola informasi bisnis, dan memantau status persetujuan dari administrator.

## Fitur Utama

- **Autentikasi Pengguna**: Sistem login dan registrasi yang aman
- **Dashboard Interaktif**: Tampilan ringkas informasi dan statistik UMKM
- **Pendaftaran UMKM**: Formulir lengkap untuk mendaftarkan usaha baru
- **Manajemen UMKM**: Pengelolaan data usaha dengan mudah
- **Sistem Persetujuan**: Alur kerja persetujuan UMKM oleh administrator
- **Kategorisasi**: Pengelompokan UMKM berdasarkan jenis usaha
- **Manajemen Regional**: Pembagian berdasarkan kabupaten/kota
- **Testimoni Pengguna**: Fitur untuk berbagi pengalaman antar pengguna

## Teknologi

- **Framework**: Laravel
- **Frontend**: Blade + Livewire + Alpine.js
- **Styling**: Tailwind CSS
- **Database**: MySQL
- **Authentication**: Laravel Breeze

## Instalasi

1. Clone repositori:
```bash
git clone https://github.com/yourusername/umkm-management.git
cd umkm-management
```

2. Install depedency:
```bash
composer install
npm install
```

3. Salin file .env:
```bash
cp .env.example .env
```

4. Konfigurasi database dan aplikasi di file .env

5. Generate application key:
```bash
php artisan key:generate
```

6. Jalankan Seeder dan migrate
```bash
php artisan migrate --seed
```
7. Compile Aset:
```bash
npm run build
```

8. Jalankan aplikasi:
```bash
php artisan serve
```

# Penggunaan
Registrasi/Login: Buat akun atau masuk dengan akun yang sudah ada
Dashboard: Lihat statistik dan informasi UMKM Anda
Pendaftaran UMKM: Klik tombol "Daftarkan UMKM" untuk menambahkan usaha baru
Manajemen UMKM: Kelola informasi usaha Anda melalui dashboard
Testimoni: Bagikan pengalaman Anda menggunakan platform

```markdown
## Struktur Folder

```
umkm-management/
├── app/
│   ├── Console/
│   ├── Exceptions/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── UmkmController.php
│   │   │   │   └── TestimonialController.php
│   │   │   ├── Auth/
│   │   │   └── UmkmController.php
│   │   ├── Middleware/
│   │   └── Requests/
│   ├── Livewire/
│   │   ├── Admin/
│   │   │   └── ManageUmkm.php
│   │   ├── Umkm/
│   │   │   ├── Pendaftaran.php
│   │   │   └── UserUmkm.php
│   │   └── Testimonials.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Umkm.php
│   │   ├── KategoriUmkm.php
│   │   ├── Kabkota.php
│   │   ├── Pembina.php
│   │   └── Testimonial.php
│   └── Providers/
├── bootstrap/
├── config/
├── database/
│   ├── factories/
│   ├── migrations/
│   │   ├── 2014_10_12_000000_create_users_table.php
│   │   ├── 2023_01_01_000000_create_kabkota_table.php
│   │   ├── 2023_01_01_000001_create_kategori_umkm_table.php
│   │   ├── 2023_01_01_000002_create_pembina_table.php
│   │   ├── 2023_01_01_000003_create_umkm_table.php
│   │   └── 2023_01_01_000004_create_testimonials_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── KabkotaSeeder.php
│       └── KategoriUmkmSeeder.php
├── public/
│   ├── css/
│   ├── js/
│   ├── storage/
│   │   └── umkm-images/
│   └── build/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
│       ├── admin/
│       │   ├── dashboard.blade.php
│       │   └── umkm/
│       │       ├── index.blade.php
│       │       ├── show.blade.php
│       │       └── edit.blade.php
│       ├── components/
│       │   ├── application-logo.blade.php
│       │   └── umkm-status-badge.blade.php
│       ├── layouts/
│       │   ├── app.blade.php
│       │   ├── guest.blade.php
│       │   └── navigation.blade.php
│       ├── livewire/
│       │   ├── testimonials.blade.php
│       │   └── umkm/
│       │       ├── pendaftaran.blade.php
│       │       └── user-umkm.blade.php
│       ├── auth/
│       ├── dashboard.blade.php
│       ├── profile/
│       └── umkm/
│           ├── detail.blade.php
│           └── form.blade.php
├── routes/
│   ├── api.php
│   ├── channels.php
│   ├── console.php
│   └── web.php
├── storage/
│   ├── app/
│   │   └── public/
│   │       └── umkm-images/
│   ├── framework/
│   └── logs/
├── tests/
├── .env.example
├── .gitignore
├── artisan
├── composer.json
├── package.json
├── README.md
└── tailwind.config.js

