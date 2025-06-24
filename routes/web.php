<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Umkm\Pendaftaran;
use App\Livewire\Umkm\UserUmkm;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'index'])->name('landing');
Route::get('/pembina', [App\Http\Controllers\PembinaController::class, 'index'])->name('pembina.index');
Route::get('/pembina/{id}', [App\Http\Controllers\PembinaController::class, 'show'])->name('pembina.detail');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/umkm/daftar', Pendaftaran::class)->name('umkm.pendaftaran');
    Route::get('/umkm/edit/{id}', \App\Livewire\Umkm\Edit::class)->name('umkm.edit');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
