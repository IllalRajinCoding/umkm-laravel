<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Dapatkan user yang sedang login
        $user = Auth::user();

        // Cek apakah user memiliki role admin
        if (!$user || $user->role !== 'admin') {
            // Jika bukan admin, redirect ke halaman unauthorized atau dashboard
            abort(403, 'Unauthorized. Admin access required.');
        }

        // Jika user adalah admin, lanjutkan request
        return $next($request);
    }
}
