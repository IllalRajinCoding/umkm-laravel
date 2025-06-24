{{-- filepath: c:\Users\Hype G12\Desktop\uas-laravel\resources\views\components\application-logo.blade.php --}}
<img src="{{ asset('logo.jpg') }}" {{ $attributes->merge(['class' => 'block h-40 w-40 logo-transparent']) }}
    alt="Logo" />

<style>
    .logo-transparent {
        background: transparent !important;
        mix-blend-mode: multiply;
        /* Menghilangkan background putih */
        filter: contrast(1.1) brightness(1.1);
        /* Enhance logo clarity */
    }
</style>
