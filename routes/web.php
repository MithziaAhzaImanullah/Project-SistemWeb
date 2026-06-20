<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Halaman utama default Laravel
Route::get('/', function () {
    return view('welcome');
});

// Dashboard pengguna setelah login (Bawaan Breeze)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Manajemen Profil Pengguna (Bawaan Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Route Uji Coba Desain Frontend (Jelajah Indonesia)
|--------------------------------------------------------------------------
*/

// 1. Halaman Pencarian Wisata
Route::get('/wisata-desain', function () {
    return view('wisata.index');
});

// 2. Halaman Detail Wisata
Route::get('/wisata-detail-desain', function () {
    return view('wisata.show');
});

// 3. Halaman Konverter Mata Uang
Route::get('/currency-desain', function () {
    return view('currency.index');
});

// 4. Halaman Login (Sudah diperbaiki & tidak duplikat)
Route::get('/login-desain', function () {
    return view('auth.login'); 
});

Route::get('/welcome-desain', function () {
    return view('welcome');
});

Route::get('/dashboard-desain', function () {
    return view('dashboard');
});

// Memuat route otentikasi bawaan dari Laravel Breeze (login, register, dll)
require __DIR__.'/auth.php';