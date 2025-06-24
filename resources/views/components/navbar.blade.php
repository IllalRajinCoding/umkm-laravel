  <nav class="bg-white/90 backdrop-blur-md border-b border-gray-100 shadow-sm sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex justify-between h-16">
              <!-- Logo & Brand -->
              <div class="flex items-center">
                  <a href="{{ route('landing') }}" class="flex items-center space-x-3 group">
                      <div
                          class="p-2 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-xl shadow-lg group-hover:shadow-xl transition-all duration-200">
                          <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                  <a href="#home" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">Beranda</a>
                  <a href="#umkm" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">UMKM</a>
                  <a href="#kategori"
                      class="text-gray-700 hover:text-blue-600 font-medium transition-colors">Kategori</a>
                  <a href="#tentang" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">Tentang</a>
                  <a href="{{ route('pembina.index') }}"
                      class="block text-gray-700 hover:text-blue-600 font-medium">Pembina</a>
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
                          <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"></path>
                          <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"></path>
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
                  <a href="{{ route('pembina.index') }}"
                      class="block text-gray-700 hover:text-blue-600 font-medium">Pembina</a>
                  @auth
                      <a href="{{ url('/dashboard') }}"
                          class="block w-full text-center bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold">
                          Dashboard
                      </a>
                  @else
                      <a href="{{ route('login') }}" class="block text-gray-700 hover:text-blue-600 font-medium">Masuk</a>
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
