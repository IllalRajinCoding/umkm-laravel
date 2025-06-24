{{-- filepath: c:\Users\Hype G12\Desktop\uas-laravel\resources\views\components\navpem.blade.php --}}
<nav x-data="{ open: false }" class="bg-white border-b border-green-100 shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('landing') }}" class="flex items-center">
                        <div class="flex items-center gap-2">
                            <div class="bg-gradient-to-r from-green-600 to-teal-600 rounded-full p-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <span class="text-xl font-bold text-gray-900">Pembina <span
                                    class="text-green-600">UMKM</span></span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links - Desktop -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <a href="{{ route('pembina.index') }}"
                        class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('pembina.index') ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium leading-5 transition">
                        Beranda Pembina
                    </a>
                    <a href="#pembina"
                        class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('pembina.list') ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium leading-5 transition">
                        Daftar Pembina
                    </a>
                    <a href="#layanan"
                        class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('pembina.layanan') ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium leading-5 transition">
                        Layanan
                    </a>
                    <a href="/"
                        class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('pembina.kontak') ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium leading-5 transition">
                        Kembali ke UMKM
                    </a>
                </div>
            </div>

            <!-- User Navigation and Authentication -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @guest
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}"
                            class="text-sm text-gray-700 hover:text-green-600 transition">Masuk</a>
                        <a href="{{ route('register') }}"
                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-600 to-teal-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-green-700 hover:to-teal-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring focus:ring-green-300 disabled:opacity-25 transition">Daftar</a>
                    </div>
                @else
                    <!-- Profile Dropdown -->
                    <div class="ml-3 relative" x-data="{ open: false }">
                        <div>
                            <button @click="open = !open"
                                class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </div>
                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                            style="display: none;">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Manajemen Akun
                            </div>

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('pembina.index') }}"
                class="block pl-3 pr-4 py-2  text-base font-medium focus:outline-none focus:text-green-800 focus:bg-green-100 focus:border-green-700 transition">
                Beranda
            </a>
            <a href="#pembina"
                class="block pl-3 pr-4 py-2 text-base font-medium focus:outline-none focus:text-green-800 focus:bg-green-100 focus:border-green-700 transition">
                Daftar Pembina
            </a>
            <a href="#layanan"
                class="block pl-3 pr-4 py-2  text-base font-medium focus:outline-none focus:text-green-800 focus:bg-green-100 focus:border-green-700 transition">
                Layanan
            </a>
            <a href="#kontak"
                class="block pl-3 pr-4 py-2 text-base font-medium focus:outline-none focus:text-green-800 focus:bg-green-100 focus:border-green-700 transition">
                Kontak
            </a>
        </div>

    </div>
</nav>
