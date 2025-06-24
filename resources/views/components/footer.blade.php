 <footer id="tentang" class="bg-gray-900 text-white py-16">
     <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
         <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
             <!-- Company Info -->
             <div class="md:col-span-2">
                 <div class="flex items-center space-x-3 mb-4">
                     <div class="p-2 bg-blue-600 rounded-xl">
                         <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
