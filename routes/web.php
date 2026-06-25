<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\WisataController;

Route::get('/', function () {
    return redirect('/wisata-desain');
});

// Grup middleware auth untuk mengamankan halaman profile dan dashboard pengguna
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Halaman Utama Dashboard (Kelola Destinasi Favorit Saya)
    Route::get('/dashboard', [FavoriteController::class, 'index'])->name('dashboard');
    
    // Aksi untuk menyimpan destinasi favorit baru ke database SQLite
    Route::post('/dashboard/favorite', [FavoriteController::class, 'store'])->name('favorite.store');
    
    // Aksi untuk menghapus destinasi favorit dari database SQLite
    Route::delete('/dashboard/favorite/{id}', [FavoriteController::class, 'destroy'])->name('favorite.destroy');
});

// Rute Tampilan Fitur Wisata Dinamis (Dikelola oleh WisataController)
Route::get('/wisata-desain', [WisataController::class, 'index'])->name('wisata.index');
Route::get('/wisata-detail-desain', [WisataController::class, 'show'])->name('wisata.show');

// Rute Fitur Konverter Kurs
Route::get('/currency-desain', function () {
    return view('currency.index');
})->name('currency.index');

require __DIR__.'/auth.php';