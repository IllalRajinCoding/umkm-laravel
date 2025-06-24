<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $umkm->nama }} | {{ config('app.name', 'Laravel') }}</title>
    <meta name="description"
        content="Detail UMKM {{ $umkm->nama }} - {{ $umkm->deskripsi_singkat ?? 'UMKM Indonesia' }}">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        @include('components.navbar')

        <!-- Main Content -->
        <main class="flex-grow">
            <!-- Simple Header Section -->
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center gap-4">
                        <!-- Small profile image -->
                        <div
                            class="h-16 w-16 rounded-full overflow-hidden flex-shrink-0 bg-white shadow-sm border-2 border-white">
                            @if (!empty($umkm->gambar))
                                <img src="{{ asset('storage/' . $umkm->gambar) }}" alt="{{ $umkm->nama }}"
                                    class="w-full h-full object-cover object-center">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-blue-100">
                                    <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                        </path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <div>
                            <div class="flex items-center flex-wrap gap-2 mb-1">
                                <span
                                    class="inline-block bg-white/20 text-white text-xs font-medium px-2 py-0.5 rounded-full">
                                    {{ $umkm->kategori->nama ?? 'Tanpa Kategori' }}
                                </span>
                                @if ($umkm->rating)
                                    <div class="flex items-center text-amber-100 gap-1">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                        <span class="text-xs font-medium">{{ $umkm->rating }}</span>
                                    </div>
                                @endif
                            </div>
                            <h1 class="text-xl font-bold text-white">{{ $umkm->nama }}</h1>
                            <p class="text-sm text-white/80">{{ $umkm->kabkota->nama ?? 'Lokasi tidak diset' }}
                                @if ($umkm->tahun_berdiri)
                                    • Berdiri {{ $umkm->tahun_berdiri }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <!-- Simple Breadcrumb -->
                <nav class="mb-4">
                    <ol class="flex items-center space-x-1 text-sm">
                        <li><a href="/" class="text-gray-500 hover:text-blue-600">Beranda</a></li>
                        <li class="text-gray-500">/</li>
                        <li class="text-blue-600 font-medium">{{ $umkm->nama }}</li>
                    </ol>
                </nav>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Left Column - Main Info -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- About -->
                        <div class="bg-white rounded-lg shadow-sm p-5">
                            <h2 class="text-lg font-semibold text-gray-900 mb-3">Tentang</h2>
                            <p class="text-gray-700">
                                {{ $umkm->deskripsi ?? 'Belum ada deskripsi untuk UMKM ini.' }}
                            </p>
                        </div>

                        <!-- Products/Services -->
                        <div class="bg-white rounded-lg shadow-sm p-5">
                            <h2 class="text-lg font-semibold text-gray-900 mb-3">Produk & Layanan</h2>
                            @if (isset($umkm->produk) && is_object($umkm->produk) && count($umkm->produk) > 0)
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                    @foreach ($umkm->produk as $produk)
                                        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                                            <div class="h-32 bg-gray-100 overflow-hidden">
                                                @if (!empty($produk->gambar))
                                                    <img src="{{ asset('storage/' . $produk->gambar) }}"
                                                        alt="{{ $produk->nama }}"
                                                        class="w-full h-full object-cover object-center">
                                                @else
                                                    <div
                                                        class="w-full h-full flex items-center justify-center bg-gray-100">
                                                        <svg class="w-8 h-8 text-gray-300" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="p-3">
                                                <h3 class="font-medium text-gray-900 text-sm">{{ $produk->nama }}</h3>
                                                <p class="text-blue-600 text-sm font-medium mt-1">
                                                    Rp {{ number_format($produk->harga ?? 0, 0, ',', '.') }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-4 text-gray-500 text-sm">
                                    Belum ada produk atau layanan yang terdaftar.
                                </div>
                            @endif
                        </div>

                        <!-- Gallery - if exists -->
                        @php
                            $hasGaleri = isset($umkm->galeri) && is_object($umkm->galeri) && count($umkm->galeri) > 0;
                        @endphp

                        @if ($hasGaleri)
                            <div class="bg-white rounded-lg shadow-sm p-5">
                                <h2 class="text-lg font-semibold text-gray-900 mb-3">Galeri</h2>
                                <div class="grid grid-cols-3 sm:grid-cols-4 gap-2">
                                    @foreach ($umkm->galeri as $foto)
                                        <div class="h-20 sm:h-24 rounded-md overflow-hidden bg-gray-100">
                                            @if (!empty($foto->gambar))
                                                <img src="{{ asset('storage/' . $foto->gambar) }}"
                                                    alt="{{ $umkm->nama }}"
                                                    class="w-full h-full object-cover object-center">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                                    <svg class="w-8 h-8 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Right Column - Contact & Details -->
                    <div class="space-y-6">
                        <!-- Owner Info - Simplified -->
                        <div class="bg-white rounded-lg shadow-sm p-5">
                            <h3 class="text-md font-semibold text-gray-900 mb-3">Informasi Pemilik</h3>
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $umkm->user->name ?? 'Tidak diketahui' }}
                                    </p>
                                    <p class="text-sm text-gray-500">Pemilik</p>
                                </div>
                            </div>
                            @if (isset($umkm->pembina) && !empty($umkm->pembina->nama))
                                <div class="mt-3 pt-3 border-t border-gray-100">
                                    <p class="text-sm text-gray-700">
                                        <span class="font-medium">Pembina:</span> {{ $umkm->pembina->nama }}
                                    </p>
                                </div>
                            @endif
                        </div>

                        <!-- Business Details - Simplified -->
                        <div class="bg-white rounded-lg shadow-sm p-5">
                            <h3 class="text-md font-semibold text-gray-900 mb-3">Detail Usaha</h3>
                            <div class="space-y-3 text-sm">
                                <div>
                                    <span class="text-gray-500">Lokasi:</span>
                                    <span class="font-medium text-gray-700">
                                        {{ $umkm->alamat ?? '' }}{{ !empty($umkm->alamat) && isset($umkm->kabkota->nama) ? ', ' : '' }}{{ $umkm->kabkota->nama ?? 'Lokasi tidak diset' }}
                                    </span>
                                </div>

                                @if ($umkm->tahun_berdiri)
                                    <div>
                                        <span class="text-gray-500">Tahun Berdiri:</span>
                                        <span class="font-medium text-gray-700">{{ $umkm->tahun_berdiri }}</span>
                                    </div>
                                @endif

                                @if ($umkm->modal)
                                    <div>
                                        <span class="text-gray-500">Modal Usaha:</span>
                                        <span class="font-medium text-gray-700">Rp
                                            {{ number_format($umkm->modal, 0, ',', '.') }}</span>
                                    </div>
                                @endif

                                @if ($umkm->jumlah_karyawan)
                                    <div>
                                        <span class="text-gray-500">Jumlah Karyawan:</span>
                                        <span class="font-medium text-gray-700">{{ $umkm->jumlah_karyawan }}
                                            orang</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Contact Info - Simplified -->
                        <div class="bg-white rounded-lg shadow-sm p-5">
                            <h3 class="text-md font-semibold text-gray-900 mb-3">Kontak</h3>
                            <div class="space-y-2">
                                @if ($umkm->telepon)
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                            </path>
                                        </svg>
                                        <a href="tel:{{ $umkm->telepon }}"
                                            class="text-blue-600 hover:underline text-sm">
                                            {{ $umkm->telepon }}
                                        </a>
                                    </div>
                                @endif

                                @if ($umkm->email)
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <a href="mailto:{{ $umkm->email }}"
                                            class="text-blue-600 hover:underline text-sm">
                                            {{ $umkm->email }}
                                        </a>
                                    </div>
                                @endif

                                @if ($umkm->website)
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9">
                                            </path>
                                        </svg>
                                        <a href="{{ $umkm->website }}" target="_blank" rel="noopener noreferrer"
                                            class="text-blue-600 hover:underline text-sm">
                                            {{ $umkm->website }}
                                        </a>
                                    </div>
                                @endif

                                @if (!empty($umkm->sosmed_facebook) || !empty($umkm->sosmed_instagram) || !empty($umkm->sosmed_tiktok))
                                    <div class="flex items-center gap-2 pt-2 mt-2 border-t border-gray-100">
                                        @if (!empty($umkm->sosmed_facebook))
                                            <a href="{{ $umkm->sosmed_facebook }}" target="_blank"
                                                rel="noopener noreferrer"
                                                class="w-7 h-7 flex items-center justify-center rounded-full bg-blue-100 text-blue-600">
                                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z" />
                                                </svg>
                                            </a>
                                        @endif

                                        @if (!empty($umkm->sosmed_instagram))
                                            <a href="{{ $umkm->sosmed_instagram }}" target="_blank"
                                                rel="noopener noreferrer"
                                                class="w-7 h-7 flex items-center justify-center rounded-full bg-pink-100 text-pink-600">
                                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                                                </svg>
                                            </a>
                                        @endif

                                        @if (!empty($umkm->sosmed_tiktok))
                                            <a href="{{ $umkm->sosmed_tiktok }}" target="_blank"
                                                rel="noopener noreferrer"
                                                class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-100 text-gray-800">
                                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M12.53.02C13.84 0 15.14.01 16.44 0c.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                                                </svg>
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Back Button - Simplified -->
                        <a href="/"
                            class="flex items-center justify-center gap-2 px-3 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-colors text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        @include('components.footer')
    </div>
</body>

</html>
