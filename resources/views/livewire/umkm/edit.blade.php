<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-8">
            <div class="flex justify-center mb-4">
                <div class="p-3 bg-amber-100 dark:bg-amber-900 rounded-full">
                    <svg class="w-8 h-8 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                </div>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Edit Data UMKM</h1>
            <p class="text-lg text-gray-600 dark:text-gray-300">Perbarui informasi UMKM Anda</p>
        </div>

        {{-- Error Messages --}}
        @error('general')
            <div class="mb-6 bg-red-50 dark:bg-red-900/20 p-4 rounded-lg" x-data="{ show: true }" x-show="show">
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-red-400 mr-3" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="text-sm text-red-800 dark:text-red-200">{{ $message }}</p>
                    <button @click="show = false"
                        class="ml-auto text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-200">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        @enderror

        {{-- Form --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
            <form wire:submit.prevent="save" class="p-8">
                <div class="space-y-12">
                    {{-- Section 1: Informasi Dasar UMKM --}}
                    <div class="border-b border-gray-900/10 dark:border-gray-700 pb-12">
                        <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white">Informasi Dasar UMKM</h2>
                        <p class="mt-1 text-sm/6 text-gray-600 dark:text-gray-400">Perbarui informasi dasar UMKM Anda.
                        </p>

                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            {{-- Nama UMKM --}}
                            <div class="col-span-full">
                                <x-input-label for="nama" :value="__('Nama UMKM')" required />
                                <x-text-input id="nama" wire:model="nama" type="text" class="mt-2 block w-full"
                                    placeholder="Masukkan nama UMKM Anda" />
                                <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                            </div>

                            {{-- Kategori UMKM --}}
                            <div class="sm:col-span-3">
                                <x-input-label for="kategori_umkm_id" :value="__('Kategori UMKM')" required />
                                <select wire:model="kategori_umkm_id" id="kategori_umkm_id"
                                    class="mt-2 col-start-1 row-start-1 w-full appearance-none rounded-md bg-white dark:bg-gray-700 py-1.5 pr-8 pl-3 text-base text-gray-900 dark:text-white outline-1 -outline-offset-1  dark:outline-gray-600 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 @error('kategori_umkm_id') outline-red-500 @enderror">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($kategori_list as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('kategori_umkm_id')" class="mt-2" />
                            </div>

                            {{-- Kabupaten/Kota --}}
                            <div class="sm:col-span-3">
                                <x-input-label for="kabkota_id" :value="__('Kabupaten/Kota')" required />
                                <select wire:model="kabkota_id" id="kabkota_id"
                                    class="mt-2 col-start-1 row-start-1 w-full appearance-none rounded-md bg-white dark:bg-gray-700 py-1.5 pr-8 pl-3 text-base text-gray-900 dark:text-white outline-1 -outline-offset-1  dark:outline-gray-600 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 @error('kabkota_id') outline-red-500 @enderror">
                                    <option value="">Pilih Kabupaten/Kota</option>
                                    @foreach ($kabkota_list as $kabkota)
                                        <option value="{{ $kabkota->id }}">{{ $kabkota->nama }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('kabkota_id')" class="mt-2" />
                            </div>

                            {{-- Alamat --}}
                            <div class="col-span-full">
                                <x-input-label for="alamat" :value="__('Alamat Lengkap')" required />
                                <textarea wire:model="alamat" id="alamat" rows="3" placeholder="Masukkan alamat lengkap UMKM"
                                    class="mt-2 block w-full rounded-md bg-white dark:bg-gray-700 px-3 py-1.5 text-base text-gray-900 dark:text-white outline-1 -outline-offset-1  dark:outline-gray-600 placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 @error('alamat') outline-red-500 @enderror"></textarea>
                                <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                            </div>

                            {{-- Gambar/Logo UMKM --}}
                            <div class="col-span-full">
                                <x-input-label for="gambar" :value="__('Gambar/Logo UMKM')" />

                                @if ($gambar)
                                    {{-- New uploaded image --}}
                                    <div class="mt-2 flex items-center gap-x-3">
                                        <img src="{{ $gambar->temporaryUrl() }}"
                                            class="size-12 rounded-lg object-cover">
                                        <x-secondary-button type="button" wire:click="$set('gambar', null)">
                                            {{ __('Hapus') }}
                                        </x-secondary-button>
                                    </div>
                                @elseif($existing_gambar)
                                    {{-- Existing image --}}
                                    <div class="mt-2 flex items-center gap-x-3">
                                        <img src="{{ Storage::url($existing_gambar) }}"
                                            class="size-12 rounded-lg object-cover">
                                        <x-secondary-button type="button" wire:click="removeExistingImage">
                                            {{ __('Hapus') }}
                                        </x-secondary-button>
                                    </div>
                                @else
                                    {{-- Upload area --}}
                                    <div
                                        class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 dark:border-gray-600 px-6 py-10">
                                        <div class="text-center">
                                            <svg class="mx-auto size-12 text-gray-300 dark:text-gray-600"
                                                viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <div class="mt-4 flex text-sm/6 text-gray-600 dark:text-gray-400">
                                                <label for="gambar"
                                                    class="relative cursor-pointer rounded-md bg-white dark:bg-gray-700 font-semibold text-indigo-600 dark:text-indigo-400 focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 focus-within:outline-hidden hover:text-indigo-500">
                                                    <span>Upload gambar</span>
                                                    <input id="gambar" wire:model="gambar" type="file"
                                                        class="sr-only" accept="image/*" />
                                                </label>
                                                <p class="pl-1">atau drag and drop</p>
                                            </div>
                                            <p class="text-xs/5 text-gray-600 dark:text-gray-400">PNG, JPG, GIF hingga
                                                10MB</p>
                                        </div>
                                    </div>
                                @endif

                                <div wire:loading wire:target="gambar"
                                    class="mt-2 text-sm text-indigo-600 dark:text-indigo-400">Mengunggah...</div>
                                <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    {{-- Section 2: Informasi Tambahan --}}
                    <div class="border-b border-gray-900/10 dark:border-gray-700 pb-12">
                        <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white">Informasi Tambahan</h2>
                        <p class="mt-1 text-sm/6 text-gray-600 dark:text-gray-400">Informasi opsional untuk melengkapi
                            profil UMKM Anda.</p>

                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            {{-- Modal Usaha --}}
                            <div class="sm:col-span-3">
                                <x-input-label for="modal" :value="__('Modal Usaha')" />
                                <div class="mt-2">
                                    <div
                                        class="flex items-center rounded-md bg-white dark:bg-gray-700 pl-3 outline-1 -outline-offset-1 outline-gray-300 dark:outline-gray-600 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                        <div
                                            class="shrink-0 text-base text-gray-500 dark:text-gray-400 select-none sm:text-sm/6">
                                            Rp</div>
                                        <x-text-input type="number" wire:model="modal" id="modal"
                                            class="block min-w-0 grow border-0 bg-transparent py-1.5 pr-3 pl-1 text-base focus:ring-0 sm:text-sm/6"
                                            placeholder="0" />
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('modal')" class="mt-2" />
                            </div>

                            {{-- Website --}}
                            <div class="sm:col-span-3">
                                <x-input-label for="website" :value="__('Website/Media Sosial')" />
                                <x-text-input id="website" wire:model="website" type="url"
                                    class="mt-2 block w-full" placeholder="https://example.com" />
                                <x-input-error :messages="$errors->get('website')" class="mt-2" />
                            </div>

                            {{-- Email UMKM --}}
                            <div class="sm:col-span-4">
                                <x-input-label for="email" :value="__('Email UMKM')" />
                                <x-text-input id="email" wire:model="email" type="email"
                                    class="mt-2 block w-full" placeholder="umkm@example.com" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Form Actions --}}
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <x-secondary-button onclick="window.location.href='{{ route('dashboard') }}'">
                        {{ __('Batal') }}
                    </x-secondary-button>

                    <x-primary-button wire:loading.attr="disabled"
                        class="bg-amber-600 hover:bg-amber-500 focus:bg-amber-700 active:bg-amber-900">
                        <span wire:loading.remove wire:target="save">{{ __('Perbarui UMKM') }}</span>
                        <span wire:loading wire:target="save" class="flex items-center gap-2">
                            <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            {{ __('Memperbarui...') }}
                        </span>
                    </x-primary-button>
                </div>
            </form>
        </div>

        {{-- Help Text --}}
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600 dark:text-gray-300">
                Butuh bantuan?
                <a href="#"
                    class="text-amber-600 dark:text-amber-400 hover:text-amber-700 dark:hover:text-amber-300 font-medium">Hubungi
                    Support</a>
            </p>
        </div>
    </div>
</div>
