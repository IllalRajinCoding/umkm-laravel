{{-- filepath: c:\Users\Hype G12\Desktop\uas-laravel\resources\views\dashboard.blade.php --}}
<x-app-layout>
    {{-- Header dengan gradient dan shadow yang lebih menarik --}}
    <x-slot name="header">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 -mx-4 -mt-4 px-4 pt-4 pb-6 mb-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                {{-- Bagian Kiri: Judul dengan style yang lebih menarik --}}
                <div class="text-white">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-white/20 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="font-bold text-2xl">
                                Selamat Datang, {{ Auth::user()->name }}!
                            </h2>
                            <p class="text-blue-100 text-sm mt-1">
                                Kelola dan pantau UMKM Anda dengan mudah
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Bagian Kanan: Tombol dengan style yang lebih modern --}}
                <div class="flex items-center gap-3">
                    <a href="{{ route('umkm.pendaftaran') }}"
                        class="inline-flex items-center gap-2 bg-white text-blue-600 hover:bg-blue-50 font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Daftarkan UMKM Baru
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    {{-- Stats Cards Section --}}
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Statistics Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                {{-- Total UMKM Card --}}
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total UMKM Saya</p>
                            <p class="text-3xl font-bold text-gray-900">{{ Auth::user()->umkm->count() }}</p>
                            <p class="text-xs text-gray-500 mt-1">UMKM yang terdaftar</p>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-xl">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Pending UMKM Card --}}
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Menunggu Persetujuan</p>
                            <p class="text-3xl font-bold text-orange-600">
                                {{ Auth::user()->umkm->where('status', 'pending')->count() }}</p>
                            <p class="text-xs text-gray-500 mt-1">Sedang dalam review</p>
                        </div>
                        <div class="p-3 bg-orange-100 rounded-xl">
                            <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Approved UMKM Card --}}
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">UMKM Aktif</p>
                            <p class="text-3xl font-bold text-green-600">
                                {{ Auth::user()->umkm->where('status', 'approved')->count() }}</p>
                            <p class="text-xs text-gray-500 mt-1">Sudah disetujui</p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-xl">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                {{-- Quick Action 1 --}}
                <div class="bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold mb-2">Daftarkan UMKM Baru</h3>
                            <p class="text-purple-100 text-sm mb-4">Mulai dengan mendaftarkan bisnis UMKM Anda</p>
                            <a href="{{ route('umkm.pendaftaran') }}"
                                class="inline-flex items-center gap-2 bg-white text-purple-600 font-semibold py-2 px-4 rounded-lg hover:bg-purple-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Daftar Sekarang
                            </a>
                        </div>
                        <div class="hidden md:block">
                            <svg class="w-16 h-16 text-white opacity-20" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Quick Action 2 --}}
                <div class="bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold mb-2">Kelola UMKM</h3>
                            <p class="text-blue-100 text-sm mb-4">Lihat dan kelola semua UMKM yang Anda miliki</p>
                            <a href="#umkm-list"
                                class="inline-flex items-center gap-2 bg-white text-blue-600 font-semibold py-2 px-4 rounded-lg hover:bg-blue-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                    </path>
                                </svg>
                                Lihat UMKM
                            </a>
                        </div>
                        <div class="hidden md:block">
                            <svg class="w-16 h-16 text-white opacity-20" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Main Content Card --}}
            <div id="umkm-list" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                {{-- Card Header --}}
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">UMKM Saya</h3>
                            <p class="text-sm text-gray-600 mt-1">Kelola semua UMKM yang telah Anda daftarkan</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ Auth::user()->umkm->count() }} Total
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Card Content --}}
                <div class="p-6">
                    @livewire('umkm.user-umkm')
                </div>
            </div>
        </div>
    </div>

    {{-- Custom Styles --}}
    @push('styles')
        <style>
            /* Custom scrollbar */
            ::-webkit-scrollbar {
                width: 6px;
            }

            ::-webkit-scrollbar-track {
                background: #f1f5f9;
            }

            ::-webkit-scrollbar-thumb {
                background: #cbd5e1;
                border-radius: 3px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: #94a3b8;
            }

            /* Smooth transitions */
            * {
                transition-property: all;
                transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            }

            /* Scroll behavior */
            html {
                scroll-behavior: smooth;
            }
        </style>
    @endpush
</x-app-layout>
