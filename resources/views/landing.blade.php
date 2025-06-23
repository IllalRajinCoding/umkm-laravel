{{-- filepath: c:\Users\Hype G12\Desktop\uas-laravel\resources\views\landing.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Platform UMKM Indonesia</title>
    <meta name="description"
        content="Platform terlengkap untuk menemukan dan mendukung UMKM lokal terbaik di Indonesia. Bergabunglah dengan komunitas UMKM digital kami.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js for interactions -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased bg-white text-gray-900">
    <div class="w-full min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white/90 backdrop-blur-md border-b border-gray-100 shadow-sm sticky top-0 z-50"
            x-data="{ mobileMenuOpen: false }">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <!-- Logo & Brand -->
                    <div class="flex items-center">
                        <a href="{{ route('landing') }}" class="flex items-center space-x-3 group">
                            <div
                                class="p-2 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-xl shadow-lg group-hover:shadow-xl transition-all duration-200">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <span class="font-bold text-xl text-gray-800">{{ config('app.name', 'UMKM') }}</span>
                                <span class="block text-xs text-gray-500 -mt-1">Platform Indonesia</span>
                            </div>
                        </a>
                    </div>

                    <!-- Desktop Navigation -->
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="#home"
                            class="text-gray-700 hover:text-blue-600 font-medium transition-colors">Beranda</a>
                        <a href="#umkm"
                            class="text-gray-700 hover:text-blue-600 font-medium transition-colors">UMKM</a>
                        <a href="#kategori"
                            class="text-gray-700 hover:text-blue-600 font-medium transition-colors">Kategori</a>
                        <a href="#tentang"
                            class="text-gray-700 hover:text-blue-600 font-medium transition-colors">Tentang</a>

                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-gray-700 hover:text-blue-600 font-medium transition-colors">
                                Masuk
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-2 rounded-lg font-semibold hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                                    Daftar
                                </a>
                            @endif
                        @endauth
                    </div>

                    <!-- Mobile menu button -->
                    <div class="md:hidden flex items-center">
                        <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-500 hover:text-gray-700">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile Navigation -->
                <div x-show="mobileMenuOpen" x-transition class="md:hidden py-4 border-t border-gray-100">
                    <div class="space-y-3">
                        <a href="#home" class="block text-gray-700 hover:text-blue-600 font-medium">Beranda</a>
                        <a href="#umkm" class="block text-gray-700 hover:text-blue-600 font-medium">UMKM</a>
                        <a href="#kategori" class="block text-gray-700 hover:text-blue-600 font-medium">Kategori</a>
                        <a href="#tentang" class="block text-gray-700 hover:text-blue-600 font-medium">Tentang</a>
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="block w-full text-center bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="block text-gray-700 hover:text-blue-600 font-medium">Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="block w-full text-center bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold">
                                    Daftar
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section id="home"
            class="relative bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-20 overflow-hidden">
            <!-- Background Decoration -->
            <div class="absolute inset-0 overflow-hidden">
                <div
                    class="absolute -top-40 -right-32 w-80 h-80 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse">
                </div>
                <div
                    class="absolute -bottom-40 -left-32 w-80 h-80 bg-indigo-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse">
                </div>
            </div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <!-- Badge -->
                    <div
                        class="inline-flex items-center gap-2 bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-medium mb-6">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                        Platform UMKM Terpercaya #1 di Indonesia
                    </div>

                    <!-- Main Heading -->
                    <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-gray-900 mb-6 leading-tight">
                        Temukan
                        <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                            UMKM Lokal
                        </span>
                        <br>
                        Terbaik di Indonesia
                    </h1>

                    <!-- Subtitle -->
                    <p class="text-xl md:text-2xl text-gray-600 mb-10 max-w-4xl mx-auto leading-relaxed">
                        Jelajahi ribuan produk dan jasa berkualitas dari para pelaku UMKM yang telah terverifikasi.
                        Dukung ekonomi lokal dan temukan solusi bisnis terbaik.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-16">
                        <a href="#umkm"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-4 rounded-xl font-semibold text-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Jelajahi UMKM
                        </a>
                        @guest
                            <a href="{{ route('register') }}"
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-3 bg-white text-blue-600 px-8 py-4 rounded-xl font-semibold text-lg border-2 border-blue-600 hover:bg-blue-50 transition-all duration-200 shadow-lg hover:shadow-xl">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Daftarkan UMKM
                            </a>
                        @endguest
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-4xl mx-auto">
                        <div class="text-center">
                            <div class="text-3xl md:text-4xl font-bold text-blue-600 mb-2">1000+</div>
                            <div class="text-gray-600 font-medium">UMKM Terdaftar</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl md:text-4xl font-bold text-green-600 mb-2">800+</div>
                            <div class="text-gray-600 font-medium">UMKM Aktif</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl md:text-4xl font-bold text-purple-600 mb-2">50+</div>
                            <div class="text-gray-600 font-medium">Kategori</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl md:text-4xl font-bold text-orange-600 mb-2">100+</div>
                            <div class="text-gray-600 font-medium">Kota</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <main id="umkm" class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl">Temukan UMKM Lokal
                        Terbaik</h2>
                    <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500">
                        Jelajahi berbagai produk dan jasa berkualitas dari para pelaku UMKM yang telah terverifikasi.
                    </p>
                </div>

                <!-- Grid Daftar UMKM -->
                @if (isset($umkms) && $umkms->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach ($umkms as $umkm)
                            <div
                                class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:-translate-y-1 transition-all duration-300 border border-gray-100 hover:border-blue-200">
                                <div class="p-6">
                                    <span
                                        class="inline-block bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded-full mb-2">
                                        {{ $umkm->kategori->nama ?? 'Tanpa Kategori' }}
                                    </span>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $umkm->nama }}</h3>
                                    <p class="text-gray-600 text-sm mb-4">
                                        <span class="font-semibold">Pemilik:</span>
                                        {{ $umkm->user->name ?? 'Tidak diketahui' }}
                                    </p>
                                    <p class="text-gray-500 text-sm mb-2">
                                        <svg class="inline-block h-4 w-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        {{ $umkm->kabkota->nama ?? 'Lokasi tidak diset' }}
                                    </p>
                                    @if ($umkm->modal)
                                        <p class="text-gray-500 text-sm mb-2">
                                            <svg class="inline-block h-4 w-4 mr-1" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                                </path>
                                            </svg>
                                            Modal: Rp {{ number_format($umkm->modal, 0, ',', '.') }}
                                        </p>
                                    @endif
                                    <p class="text-gray-500 text-sm">
                                        <svg class="inline-block h-4 w-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4M8 7l-5 5v6a1 1 0 001 1h16a1 1 0 001-1v-6l-5-5M8 7h8">
                                            </path>
                                        </svg>
                                        
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Tombol Paginasi -->
                    @if (method_exists($umkms, 'links'))
                        <div class="mt-12">
                            {{ $umkms->links() }}
                        </div>
                    @endif
                @else
                    <div class="text-center bg-white p-12 rounded-lg shadow">
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
                                class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
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

        <!-- CTA Section -->
        <section class="py-20 bg-gradient-to-br from-blue-600 to-indigo-700 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Bergabunglah dengan Komunitas UMKM</h2>
                <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                    Daftarkan UMKM Anda dan jangkau lebih banyak pelanggan. Gratis dan mudah!
                </p>
                @guest
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center gap-3 bg-white text-blue-600 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-blue-50 transition-all duration-200 shadow-lg hover:shadow-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Daftar Sekarang
                    </a>
                @else
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center gap-3 bg-white text-blue-600 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-blue-50 transition-all duration-200 shadow-lg hover:shadow-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Kelola UMKM
                    </a>
                @endguest
            </div>
        </section>

        <!-- Footer -->
        <footer id="tentang" class="bg-gray-900 text-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <!-- Company Info -->
                    <div class="md:col-span-2">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="p-2 bg-blue-600 rounded-xl">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                            </div>
                            <span class="font-bold text-xl">{{ config('app.name', 'UMKM') }}</span>
                        </div>
                        <p class="text-gray-300 mb-6 max-w-md">
                            Platform terdepan untuk menghubungkan UMKM lokal dengan pelanggan di seluruh Indonesia.
                            Membangun ekonomi digital yang kuat dan berkelanjutan.
                        </p>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h3 class="font-semibold text-lg mb-4">Tautan Cepat</h3>
                        <ul class="space-y-2">
                            <li><a href="#home" class="text-gray-300 hover:text-white transition-colors">Beranda</a>
                            </li>
                            <li><a href="#umkm" class="text-gray-300 hover:text-white transition-colors">Daftar
                                    UMKM</a></li>
                            @guest
                                <li><a href="{{ route('register') }}"
                                        class="text-gray-300 hover:text-white transition-colors">Daftar UMKM</a></li>
                            @endguest
                        </ul>
                    </div>

                    <!-- Contact -->
                    <div>
                        <h3 class="font-semibold text-lg mb-4">Kontak</h3>
                        <ul class="space-y-2 text-gray-300">
                            <li>Email: info@umkm.id</li>
                            <li>Phone: +62 123 456 789</li>
                            <li>WhatsApp: +62 987 654 321</li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                    <p>&copy; {{ date('Y') }} {{ config('app.name', 'UMKM') }}. Semua hak dilindungi.</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scroll to Top Button -->
    <button x-data="{ show: false }" x-show="show" x-transition @scroll.window="show = window.pageYOffset > 500"
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="fixed bottom-6 right-6 bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 transition-colors z-40">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18">
            </path>
        </svg>
    </button>

    <!-- Custom Styles -->
    <style>
        html {
            scroll-behavior: smooth;
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
</body>

</html>
