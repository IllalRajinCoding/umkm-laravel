<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Filament\Notifications\Notification; // <-- 1. Import class Notifikasi

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // == KIRIM NOTIFIKASI KE ADMIN DI SINI ==
        // 2. Ambil semua user yang memiliki role 'admin'
        $admins = User::where('role', 'admin')->get();

        // 3. Buat dan kirim notifikasi
        Notification::make()
            ->title('Pengguna Baru Terdaftar')
            ->body("Pengguna baru dengan nama '{$user->name}' telah mendaftar.")
            ->info() // Memberi warna biru (informasi)
            ->sendToDatabase($admins);
        // == AKHIR BLOK NOTIFIKASI ==

        event(new Registered($user));

        Auth::login($user);
        if ($user->role === 'admin') {
            return redirect('/admin');
        }

        return redirect(route('dashboard', absolute: false));
    }
}
