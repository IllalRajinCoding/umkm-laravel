<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pembina->nama }} - Pembina UMKM | {{ config('app.name') }}</title>
    <meta name="description"
        content="Profil lengkap {{ $pembina->nama }}, pembina UMKM profesional dengan keahlian {{ $pembina->keahlian }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js for interactions -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <!-- Include the Pembina Navbar -->
    @include('components.navpem')

    <main class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb Navigation -->
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('landing') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-green-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                </path>
                            </svg>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('pembina.index') }}"
                                class="ml-1 text-sm font-medium text-gray-700 hover:text-green-600 md:ml-2">Pembina</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-green-600 md:ml-2">{{ $pembina->nama }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Profile Header -->
            <div class="bg-white shadow rounded-lg mb-8 overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-teal-500 h-48 relative">
                    <!-- Optional background pattern -->
                    <div class="absolute inset-0 opacity-10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                            <defs>
                                <pattern id="dots" width="30" height="30" patternUnits="userSpaceOnUse">
                                    <circle cx="5" cy="5" r="2" fill="currentColor" />
                                </pattern>
                            </defs>
                            <rect width="100%" height="100%" fill="url(#dots)" />
                        </svg>
                    </div>
                </div>

                <div class="relative px-6 pb-6">
                    <div class="flex flex-col md:flex-row">
                        <!-- Profile Image -->
                        <div class="relative -mt-16 md:mr-6 flex-shrink-0">
                            <div
                                class="h-32 w-32 rounded-full border-4 border-white bg-green-100 shadow-lg flex items-center justify-center">
                                <svg class="h-16 w-16 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Profile Info -->
                        <div class="mt-6 md:mt-0 flex-grow">
                            <div class="flex flex-col md:flex-row md:items-center justify-between">
                                <div>
                                    <h1 class="text-3xl font-bold text-gray-900">{{ $pembina->nama }}</h1>
                                    <p class="text-green-600 font-semibold">{{ $pembina->keahlian }}</p>
                                </div>
                                <div class="mt-4 md:mt-0">
                                    <a href="#contact"
                                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-600 to-teal-600 text-white text-sm font-medium rounded-md shadow-sm hover:from-green-700 hover:to-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        Hubungi Pembina
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Left Column - Personal Info -->
                <div class="md:col-span-1">
                    <div class="bg-white shadow rounded-lg p-6 mb-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Informasi Pribadi</h2>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nama Lengkap</p>
                                <p class="mt-1 text-gray-900">{{ $pembina->nama }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Gender</p>
                                <p class="mt-1 text-gray-900">
                                    @if ($pembina->gender == 'L')
                                        Laki-laki
                                    @elseif($pembina->gender == 'P')
                                        Perempuan
                                    @else
                                        {{ $pembina->gender }}
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Tanggal Lahir</p>
                                <p class="mt-1 text-gray-900">
                                    {{ \Carbon\Carbon::parse($pembina->tgl_lahir)->format('d F Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Tempat Lahir</p>
                                <p class="mt-1 text-gray-900">{{ $pembina->tmp_lahir }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Usia</p>
                                <p class="mt-1 text-gray-900">{{ \Carbon\Carbon::parse($pembina->tgl_lahir)->age }}
                                    Tahun</p>
                            </div>
                        </div>
                    </div>

                    <!-- Expertise Section -->
                    <div class="bg-white shadow rounded-lg p-6 mb-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Bidang Keahlian</h2>
                        <div class="space-y-2">
                            @foreach (explode(',', $pembina->keahlian) as $skill)
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 mr-2 mb-2">
                                    <svg class="mr-1.5 h-4 w-4" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    {{ trim($skill) }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Stats Section -->
                    <div class="bg-white shadow rounded-lg p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Statistik</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-green-50 p-4 rounded-lg text-center">
                                <p class="text-2xl font-bold text-green-600">{{ $pembina->umkm->count() }}</p>
                                <p class="text-sm text-gray-600">UMKM Dibina</p>
                            </div>
                            <div class="bg-teal-50 p-4 rounded-lg text-center">
                                <p class="text-2xl font-bold text-teal-600">{{ rand(1, 10) }}</p>
                                <p class="text-sm text-gray-600">Tahun Pengalaman</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - UMKM List & Contact Form -->
                <div class="md:col-span-2">
                    <!-- UMKM Binaan Section -->
                    <div class="bg-white shadow rounded-lg p-6 mb-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">UMKM yang Dibina</h2>

                        @if ($pembina->umkm && $pembina->umkm->count() > 0)
                            <div class="space-y-6">
                                @foreach ($pembina->umkm as $umkm)
                                    <div
                                        class="flex items-start p-4 bg-gray-50 rounded-lg border border-gray-100 hover:border-green-200 transition-all">
                                        <div class="flex-shrink-0 mr-4 mt-1">
                                            <div
                                                class="h-12 w-12 rounded-md bg-green-100 flex items-center justify-center">
                                                <svg class="h-6 w-6 text-green-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="text-lg font-semibold text-gray-900">{{ $umkm->nama }}</h3>
                                            <div class="mt-1 space-y-1 text-sm">
                                                @if ($umkm->user)
                                                    <p class="text-gray-600">
                                                        <span class="font-medium">Pemilik:</span>
                                                        {{ $umkm->user->name }}
                                                    </p>
                                                @endif

                                                @if ($umkm->kabkota)
                                                    <p class="text-gray-600">
                                                        <span class="font-medium">Lokasi:</span>
                                                        {{ $umkm->kabkota->nama }}
                                                    </p>
                                                @endif

                                                @if ($umkm->kategori)
                                                    <p class="text-gray-600">
                                                        <span class="font-medium">Kategori:</span>
                                                        {{ $umkm->kategori->nama }}
                                                    </p>
                                                @endif

                                                @if ($umkm->modal)
                                                    <p class="text-gray-600">
                                                        <span class="font-medium">Modal:</span> Rp
                                                        {{ number_format($umkm->modal, 0, ',', '.') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <a href="#"
                                                class="inline-flex items-center text-sm font-medium text-green-600 hover:text-green-800">
                                                Lihat Detail
                                                <svg class="ml-1 w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="bg-gray-50 rounded-lg p-6 text-center">
                                <div class="flex justify-center mb-4">
                                    <div class="p-3 bg-gray-100 rounded-full">
                                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada UMKM Binaan</h3>
                                <p class="text-gray-500 max-w-md mx-auto">Pembina ini belum memiliki UMKM yang dibina
                                    saat ini.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Contact Section -->
                    <div id="contact" class="bg-white shadow rounded-lg p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Hubungi Pembina</h2>
                        <p class="text-gray-600 mb-6">Tertarik untuk mendapatkan bimbingan dari {{ $pembina->nama }}?
                            Silakan isi formulir di bawah ini, dan tim kami akan menghubungkan Anda.</p>

                        <form class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nama
                                    Lengkap</label>
                                <input type="text" id="name" name="name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" id="email" name="email"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Nomor
                                    Telepon</label>
                                <input type="text" id="phone" name="phone"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                            </div>

                            <div>
                                <label for="umkm" class="block text-sm font-medium text-gray-700">Nama UMKM (Jika
                                    Ada)</label>
                                <input type="text" id="umkm" name="umkm"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                            </div>

                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700">Pesan</label>
                                <textarea id="message" name="message" rows="4"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                                    placeholder="Jelaskan kebutuhan Anda..."></textarea>
                            </div>

                            <div>
                                <button type="submit"
                                    class="w-full flex justify-center items-center px-4 py-3 bg-gradient-to-r from-green-600 to-teal-600 text-white text-sm font-medium rounded-md shadow-sm hover:from-green-700 hover:to-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                    Kirim Pesan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    @include('components.footer')

    <!-- Scroll to Top Button -->
    <button x-data="{ show: false }" x-show="show" x-transition @scroll.window="show = window.pageYOffset > 500"
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="fixed bottom-6 right-6 bg-green-600 text-white p-3 rounded-full shadow-lg hover:bg-green-700 transition-colors z-40">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18">
            </path>
        </svg>
    </button>
</body>

</html>
