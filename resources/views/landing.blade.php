<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Platform UMKM Indonesia</title>
    <meta name="description"
        content="Platform terlengkap untuk menemukan dan mendukung UMKM lokal terbaik di Indonesia. Bergabunglah dengan komunitas UMKM digital kami.">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/indonesiaLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <style>
        /* Map Styles */
        #indonesia-map {
            width: 100%;
            height: 100%;
            min-height: 400px;
            background-color: theme('colors.gray.100');
        }

        @media (min-width: 768px) {
            #indonesia-map {
                min-height: 500px;
            }
        }

        /* Map Container */
        .map-container {
            position: relative;
            height: 100%;
            overflow: hidden;
            border-radius: 0.75rem;
        }

        /* Loading Indicator */
        .loading-indicator {
            position: absolute;
            inset: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(255, 255, 255, 0.9);
            z-index: 10;
            backdrop-filter: blur(2px);
        }

        /* Province Card Animation */
        .province-item {
            transition: transform-shadow 0.3s ease;
        }

        .province-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
                0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        /* Focus Styles for Accessibility */
        button:focus,
        a:focus {
            outline: 2px solid #2563eb;
            /* Replace with the actual primary color value */
            outline-offset: 2px;
        }
    </style>
</head>

<body class="font-sans antialiased bg-white text-gray-900">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        @include('components.navbar')

        <!-- Hero Section -->
        <section id="home"
            class="relative bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-20 md:py-28 overflow-hidden">
            <!-- Animated Background Elements -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div
                    class="absolute -top-40 -right-32 w-80 h-80 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse">
                </div>
                <div
                    class="absolute -bottom-40 -left-32 w-80 h-80 bg-indigo-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse">
                </div>
                <div
                    class="absolute top-1/2 left-1/4 w-40 h-40 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-15 animate-pulse delay-300">
                </div>
            </div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <!-- Trust Badge -->
                    <div
                        class="inline-flex items-center gap-2 bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-medium mb-6 animate-fade-in">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                        Platform UMKM Terpercaya #1 di Indonesia
                    </div>

                    <!-- Main Heading -->
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Temukan
                        <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                            UMKM Lokal
                        </span>
                        Terbaik di Indonesia
                    </h1>

                    <!-- Subtitle -->
                    <p class="text-lg md:text-xl text-gray-600 mb-10 max-w-3xl mx-auto leading-relaxed">
                        Jelajahi ribuan produk dan jasa berkualitas dari para pelaku UMKM yang telah terverifikasi.
                        Dukung ekonomi lokal dan temukan solusi bisnis terbaik.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-16">
                        <a href="#umkm"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-4 rounded-xl font-semibold text-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Jelajahi UMKM
                        </a>
                        @guest
                            <a href="{{ route('register') }}"
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-3 bg-white text-blue-600 px-8 py-4 rounded-xl font-semibold text-lg border-2 border-blue-600 hover:bg-blue-50 transition-all duration-200 shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Daftarkan UMKM
                            </a>
                        @endguest
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-4xl mx-auto">
                        <div
                            class="text-center p-4 bg-white/50 backdrop-blur-sm rounded-lg border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 hover:transform hover:scale-105">
                            <div class="text-3xl font-bold text-blue-600 mb-2 counter" data-target="1000">0</div>
                            <div class="text-gray-600 font-medium">UMKM Terdaftar</div>
                        </div>
                        <div
                            class="text-center p-4 bg-white/50 backdrop-blur-sm rounded-lg border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 hover:transform hover:scale-105">
                            <div class="text-3xl font-bold text-green-600 mb-2 counter" data-target="800">0</div>
                            <div class="text-gray-600 font-medium">UMKM Aktif</div>
                        </div>
                        <div
                            class="text-center p-4 bg-white/50 backdrop-blur-sm rounded-lg border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 hover:transform hover:scale-105">
                            <div class="text-3xl font-bold text-purple-600 mb-2 counter" data-target="50">0</div>
                            <div class="text-gray-600 font-medium">Kategori</div>
                        </div>
                        <div
                            class="text-center p-4 bg-white/50 backdrop-blur-sm rounded-lg border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 hover:transform hover:scale-105">
                            <div class="text-3xl font-bold text-orange-600 mb-2 counter" data-target="100">0</div>
                            <div class="text-gray-600 font-medium">Kota</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <main id="umkm" class="flex-grow py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">Temukan UMKM Lokal
                        Terbaik</h2>
                    <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-500">
                        Jelajahi berbagai produk dan jasa berkualitas dari para pelaku UMKM yang telah terverifikasi.
                    </p>
                </div>

                <!-- Categories Filter -->
                <div class="mb-8">
                    <div class="flex flex-wrap gap-2 justify-center">
                        <button
                            class="px-4 py-2 rounded-full bg-blue-600 text-white font-medium hover:bg-blue-700 transition-colors duration-200">
                            Semua Kategori
                        </button>
                        @foreach (['Kuliner', 'Fashion', 'Kerajinan', 'Digital', 'Jasa'] as $category)
                            <button
                                class="px-4 py-2 rounded-full bg-white border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 hover:border-blue-300 transition-colors duration-200">
                                {{ $category }}
                            </button>
                        @endforeach
                        <button
                            class="px-4 py-2 rounded-full bg-white border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 hover:border-blue-300 transition-colors duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Grid Daftar UMKM -->
                @if (isset($umkms) && $umkms->count() > 0)
                    <div x-data="{ showAll: false, totalItems: {{ $umkms->count() }} }">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach ($umkms as $index => $umkm)
                                <div x-show="showAll || {{ $index }} < 3"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 transform scale-95"
                                    x-transition:enter-end="opacity-100 transform scale-100"
                                    class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1 border border-gray-100">
                                    <!-- UMKM Image -->
                                    <div class="h-48 w-full bg-gray-100 overflow-hidden">
                                        @if ($umkm->gambar)
                                            <img src="{{ asset('storage/' . $umkm->gambar) }}" alt="{{ $umkm->nama }}"
                                                class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                                        @else
                                            <div
                                                class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                                <svg class="w-16 h-16 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                                    </path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="p-6">
                                        <div class="flex justify-between items-center mb-3">
                                            <span
                                                class="inline-block bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                                {{ $umkm->kategori->nama ?? 'Tanpa Kategori' }}
                                            </span>
                                            @if ($umkm->rating)
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 text-yellow-500" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                        </path>
                                                    </svg>
                                                    <span
                                                        class="ml-1 text-sm font-medium text-gray-600">{{ $umkm->rating }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $umkm->nama }}</h3>
                                        <p class="text-gray-600 text-sm mb-4">
                                            <span class="font-semibold">Pemilik:</span>
                                            {{ $umkm->user->name ?? 'Tidak diketahui' }}
                                        </p>
                                        <div class="space-y-2">
                                            <p class="text-gray-500 text-sm flex items-center">
                                                <svg class="flex-shrink-0 h-4 w-4 mr-2" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                    </path>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                {{ $umkm->kabkota->nama ?? 'Lokasi tidak diset' }}
                                            </p>
                                            @if ($umkm->modal)
                                                <p class="text-gray-500 text-sm flex items-center">
                                                    <svg class="flex-shrink-0 h-4 w-4 mr-2" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                                        </path>
                                                    </svg>
                                                    Modal: Rp {{ number_format($umkm->modal, 0, ',', '.') }}
                                                </p>
                                            @endif
                                            @if ($umkm->pembina)
                                                <p class="text-gray-500 text-sm flex items-center">
                                                    <svg class="flex-shrink-0 h-4 w-4 mr-2" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                        </path>
                                                    </svg>
                                                    Pembina: {{ $umkm->pembina->nama }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="mt-4 pt-4 border-t border-gray-100">
                                            <a href="{{ route('umkm.show', $umkm->id) }}"
                                                class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                                                Lihat detail
                                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- View More Button -->
                        <div class="mt-10 text-center" x-show="totalItems > 3">
                            <button x-show="!showAll" @click="showAll = true"
                                class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                                Lihat Semua UMKM ({{ $umkms->count() }})
                            </button>

                            <button x-show="showAll" @click="showAll = false"
                                class="inline-flex items-center gap-2 px-6 py-3 bg-gray-200 text-gray-700 font-medium rounded-lg hover:bg-gray-300 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 15l7-7 7 7"></path>
                                </svg>
                                Sembunyikan
                            </button>
                        </div>
                    </div>
                @else
                    <div class="text-center bg-white p-12 rounded-lg shadow-sm border border-gray-100">
                        <div class="flex justify-center mb-4">
                            <div class="p-3 bg-gray-100 rounded-full">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-medium text-gray-900 mb-2">Belum Ada UMKM</h3>
                        <p class="text-sm text-gray-500 mb-6">Saat ini belum ada UMKM yang terverifikasi. Silakan cek
                            kembali nanti.</p>
                        @guest
                            <a href="{{ route('register') }}"
                                class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Daftarkan UMKM Pertama
                            </a>
                        @endguest
                    </div>
                @endif
            </div>
        </main>

        <!-- Featured Categories Section -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-extrabold tracking-tight text-gray-900">Kategori Unggulan</h2>
                    <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-500">
                        Temukan UMKM berdasarkan kategori yang Anda butuhkan
                    </p>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 sm:gap-6">
                    @foreach (['Kuliner', 'Fashion', 'Kerajinan', 'Digital', 'Jasa', 'Lainnya'] as $index => $category)
                        <div
                            class="bg-white rounded-xl shadow-sm p-6 text-center hover:shadow-md transition-all hover:-translate-y-1 duration-300 border border-gray-100">
                            <div
                                class="w-12 h-12 bg-blue-100 rounded-lg mx-auto mb-4 flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    @switch($index)
                                        @case(0)
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        @break

                                        @case(1)
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                        @break

                                        @case(2)
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                                            </path>
                                        @break

                                        @default
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    @endswitch
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $category }}</h3>
                            <p class="text-sm text-gray-500 mt-1">{{ rand(10, 100) }}+ UMKM</p>
                            <a href="#"
                                class="mt-3 inline-block text-blue-600 text-sm hover:text-blue-800 font-medium">
                                Lihat semua
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <section id="lokasi" class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-dark mb-4">Jelajahi UMKM Berdasarkan <span
                            class="text-primary">Lokasi</span></h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Temukan produk UMKM dari berbagai daerah di seluruh Indonesia.
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="grid grid-cols-1 lg:grid-cols-3">
                        <!-- Map Visualization -->
                        <div class="lg:col-span-2 p-6">
                            <div class="map-container h-full min-h-[400px]">
                                <div id="indonesia-map"></div>
                                <div class="loading-indicator">
                                    <div class="text-center p-4 bg-white bg-opacity-90 rounded-lg shadow-sm">
                                        <div
                                            class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-primary mx-auto mb-4">
                                        </div>
                                        <p class="text-gray-700 font-medium">Memuat peta interaktif...</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Location List -->
                        <div class="bg-gray-50 p-6 border-t lg:border-t-0 lg:border-l border-gray-200">
                            <h3 class="text-xl font-bold text-dark mb-4">Provinsi Populer</h3>
                            <div class="space-y-3 max-h-[360px] overflow-y-auto pr-2" id="province-list">
                                <!-- Province items will be added by JavaScript -->
                            </div>

                            <div class="mt-6">
                                <a href="#" class="text-primary font-medium hover:underline flex items-center">
                                    Lihat Semua Provinsi <i class="fas fa-chevron-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-extrabold tracking-tight text-gray-900">Testimoni Pelaku UMKM</h2>
                    <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-500">
                        Dengarkan langsung dari para pengusaha yang telah bergabung dengan platform kami
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach (range(1, 3) as $i)
                        <div class="bg-gray-50 rounded-xl p-6 shadow-sm relative">
                            <div class="absolute -top-4 left-6 text-blue-500 text-5xl leading-none">"</div>
                            <div class="relative">
                                <p class="text-gray-600 italic mb-6 pt-2">Platform ini sangat membantu saya memasarkan
                                    produk UMKM secara lebih luas. Kini pesanan datang dari berbagai kota di Indonesia.
                                </p>
                                <div class="flex items-center">
                                    <div
                                        class="h-12 w-12 rounded-full bg-gray-200 flex items-center justify-center mr-4">
                                        <svg class="h-6 w-6 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900">Pengusaha {{ $i }}</h4>
                                        <p class="text-sm text-gray-500">UMKM Kategori {{ $i }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-16 bg-gradient-to-br from-blue-600 to-indigo-700 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="max-w-3xl mx-auto">
                    <h2 class="text-3xl font-bold mb-6">Bergabunglah dengan Komunitas UMKM</h2>
                    <p class="text-lg text-blue-100 mb-8">
                        Daftarkan UMKM Anda dan jangkau lebih banyak pelanggan. Gratis dan mudah!
                    </p>
                    @guest
                        <a href="{{ route('register') }}"
                            class="inline-flex items-center gap-3 bg-white text-blue-600 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-blue-50 transition-all duration-200 shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Daftar Sekarang
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center gap-3 bg-white text-blue-600 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-blue-50 transition-all duration-200 shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Kelola UMKM
                        </a>
                    @endguest
                </div>
            </div>
        </section>

        <!-- Footer -->
        @include('components.footer')
    </div>

    <!-- Scroll to Top Button -->
    <button x-data="{ show: false }" x-show="show" x-transition @scroll.window="show = window.pageYOffset > 500"
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="fixed bottom-6 right-6 bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 transition-colors z-40 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-600">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18">
            </path>
        </svg>
    </button>

    <!-- Custom Styles and Scripts -->
    <style>
        html {
            scroll-behavior: smooth;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Counter animation for stats
            const counters = document.querySelectorAll('.counter');
            const speed = 200;

            counters.forEach(counter => {
                const target = +counter.dataset.target;
                const increment = target / speed;
                let count = 0;

                const updateCount = () => {
                    count += increment;
                    if (count < target) {
                        counter.innerText = Math.ceil(count);
                        setTimeout(updateCount, 10);
                    } else {
                        counter.innerText = target;
                    }
                };

                updateCount();
            });
        });
    </script>
</body>

</html>
