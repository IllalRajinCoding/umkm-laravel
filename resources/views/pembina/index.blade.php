<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Pembina UMKM Indonesia</title>
    <meta name="description"
        content="Temui para pembina profesional yang mendampingi UMKM lokal di Indonesia. Dapatkan bimbingan dari ahli terbaik di bidangnya.">

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
        @include('components.navpem')

        <!-- Hero Section -->
        <section id="home"
            class="relative bg-gradient-to-br from-green-50 via-white to-teal-50 py-20 overflow-hidden">
            <!-- Background Decoration -->
            <div class="absolute inset-0 overflow-hidden">
                <div
                    class="absolute -top-40 -right-32 w-80 h-80 bg-green-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse">
                </div>
                <div
                    class="absolute -bottom-40 -left-32 w-80 h-80 bg-teal-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse">
                </div>
            </div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <!-- Badge -->
                    <div
                        class="inline-flex items-center gap-2 bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-medium mb-6">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Pendamping UMKM Profesional
                    </div>

                    <!-- Main Heading -->
                    <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-gray-900 mb-6 leading-tight">
                        Bertemu dengan
                        <span class="bg-gradient-to-r from-green-600 to-teal-600 bg-clip-text text-transparent">
                            Pembina UMKM
                        </span>
                        <br>
                        Terbaik di Indonesia
                    </h1>

                    <!-- Subtitle -->
                    <p class="text-xl md:text-2xl text-gray-600 mb-10 max-w-4xl mx-auto leading-relaxed">
                        Temui para ahli yang siap membantu mengembangkan bisnis UMKM Anda melalui bimbingan profesional,
                        pelatihan, dan pendampingan strategis.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-16">
                        <a href="#pembina"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-3 bg-gradient-to-r from-green-600 to-teal-600 text-white px-8 py-4 rounded-xl font-semibold text-lg hover:from-green-700 hover:to-teal-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Temukan Pembina
                        </a>
                        <a href="#layanan"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-3 bg-white text-green-600 px-8 py-4 rounded-xl font-semibold text-lg border-2 border-green-600 hover:bg-green-50 transition-all duration-200 shadow-lg hover:shadow-xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Layanan Kami
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-4xl mx-auto">
                        <div class="text-center">
                            <div class="text-3xl md:text-4xl font-bold text-green-600 mb-2">50+</div>
                            <div class="text-gray-600 font-medium">Pembina Ahli</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl md:text-4xl font-bold text-teal-600 mb-2">20+</div>
                            <div class="text-gray-600 font-medium">Bidang Keahlian</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl md:text-4xl font-bold text-emerald-600 mb-2">500+</div>
                            <div class="text-gray-600 font-medium">UMKM Dibina</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl md:text-4xl font-bold text-lime-600 mb-2">10+</div>
                            <div class="text-gray-600 font-medium">Tahun Pengalaman</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content: Pembina List -->
        <main id="pembina" class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl">Pembina UMKM
                        Profesional</h2>
                    <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500">
                        Bertemu dengan para ahli yang siap membantu Anda mengembangkan bisnis UMKM melalui pendampingan
                        profesional.
                    </p>
                </div>

                <!-- Grid Daftar Pembina -->
                @if (isset($pembinas) && $pembinas->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" >
                        @foreach ($pembinas as $pembina)
                            <div
                                class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:-translate-y-1 transition-all duration-300 border border-gray-100 hover:border-green-200">
                                <div class="p-6">
                                    <div class="flex items-center mb-4">
                                        <div
                                            class="h-16 w-16 rounded-full bg-green-100 flex items-center justify-center mr-4">
                                            <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-xl font-bold text-gray-900">{{ $pembina->nama }}</h3>
                                            <span
                                                class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                                {{ $pembina->keahlian }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="space-y-2 text-gray-500 text-sm">
                                        <p>
                                            <svg class="inline-block h-4 w-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                </path>
                                            </svg>
                                            <span class="font-medium">Gender:</span> {{ $pembina->gender? 'Laki-laki' : 'Perempuan' }}
                                        </p>

                                        <p>
                                            <svg class="inline-block h-4 w-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <span class="font-medium">Tanggal Lahir:</span>
                                            {{ \Carbon\Carbon::parse($pembina->tgl_lahir)->format('d M Y') }}
                                        </p>

                                        <p>
                                            <svg class="inline-block h-4 w-4 mr-1" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span class="font-medium">Tempat Lahir:</span> {{ $pembina->tmp_lahir }}
                                        </p>

                                        @if ($pembina->umkm && $pembina->umkm->count() > 0)
                                            <p>
                                                <svg class="inline-block h-4 w-4 mr-1" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                                    </path>
                                                </svg>
                                                <span class="font-medium">Membina:</span> {{ $pembina->umkm->count() }}
                                                UMKM
                                            </p>
                                        @endif
                                    </div>

                                    <div class="mt-6">
                                        <a href="{{ route('pembina.detail', $pembina->id) }}"
                                            class="inline-flex items-center text-sm font-medium text-green-600 hover:text-green-800">
                                            Lihat Profil Lengkap
                                            <svg class="ml-1 w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Tombol Paginasi -->
                    @if (method_exists($pembinas, 'links'))
                        <div class="mt-12">
                            {{ $pembinas->links() }}
                        </div>
                    @endif
                @else
                    <div class="text-center bg-white p-12 rounded-lg shadow">
                        <div class="flex justify-center mb-4">
                            <div class="p-3 bg-gray-100 rounded-full">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-medium text-gray-900 mb-2">Belum Ada Pembina</h3>
                        <p class="text-sm text-gray-500 mb-6">Saat ini belum ada Pembina yang terdaftar. Silakan cek
                            kembali nanti.</p>
                    </div>
                @endif
            </div>
        </main>

        <!-- Services Section -->
        <section id="layanan" class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-extrabold text-gray-900">Layanan Pembinaan UMKM</h2>
                    <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500">
                        Berbagai layanan profesional untuk membantu UMKM Anda berkembang dan naik ke level berikutnya.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                    <!-- Service 1 -->
                    <div
                        class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow border-t-4 border-green-500">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-gray-900">Pendampingan Bisnis</h3>
                        <p class="text-gray-600 mb-4">
                            Konsultasi rutin dengan pembina ahli untuk membantu menyelesaikan tantangan bisnis dan
                            mengembangkan strategi pertumbuhan.
                        </p>
                    </div>

                    <!-- Service 2 -->
                    <div
                        class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow border-t-4 border-teal-500">
                        <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-gray-900">Pelatihan Keterampilan</h3>
                        <p class="text-gray-600 mb-4">
                            Workshop dan pelatihan untuk meningkatkan kemampuan manajemen, keuangan, pemasaran digital,
                            dan operasional bisnis.
                        </p>
                    </div>

                    <!-- Service 3 -->
                    <div
                        class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow border-t-4 border-emerald-500">
                        <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-gray-900">Analisis & Laporan</h3>
                        <p class="text-gray-600 mb-4">
                            Mendapatkan analisis mendalam tentang kinerja bisnis Anda dan rekomendasi strategis untuk
                            perbaikan berkelanjutan.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 bg-gradient-to-br from-green-600 to-teal-700 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Siap Mengembangkan UMKM Anda?</h2>
                <p class="text-xl text-green-100 mb-8 max-w-2xl mx-auto">
                    Dapatkan akses ke pembina profesional untuk membantu bisnis Anda tumbuh lebih cepat dan
                    berkelanjutan.
                </p>
                @guest
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center gap-3 bg-white text-green-600 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-green-50 transition-all duration-200 shadow-lg hover:shadow-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Daftarkan UMKM Anda
                    </a>
                @else
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center gap-3 bg-white text-green-600 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-green-50 transition-all duration-200 shadow-lg hover:shadow-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                        Hubungi Pembina
                    </a>
                @endguest
            </div>
        </section>

        <!-- Footer -->
        @include('components.footer')
    </div>

    <!-- Scroll to Top Button -->
    <button x-data="{ show: false }" x-show="show" x-transition @scroll.window="show = window.pageYOffset > 500"
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="fixed bottom-6 right-6 bg-green-600 text-white p-3 rounded-full shadow-lg hover:bg-green-700 transition-colors z-40">
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
