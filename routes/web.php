<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuController; 
use App\Http\Controllers\PeminjamanController;

// Halaman awal (welcome)
Route::get('/', function () {
    return view('welcome');
});

// Halaman dashboard (hanya bisa diakses setelah login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Grup route yang hanya bisa diakses oleh user yang sudah login
Route::middleware('auth')->group(function () {

    // Rute untuk fitur edit profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute resource untuk anggota
    Route::prefix('anggota')->name('anggota.')->group(function () {
        Route::get('/', [AnggotaController::class, 'index'])->name('index');
        Route::get('/create', [AnggotaController::class, 'create'])->name('create');
        Route::post('/', [AnggotaController::class, 'store'])->name('store');
        Route::get('/{idanggota}/edit', [AnggotaController::class, 'edit'])->name('edit');
        Route::put('/{idanggota}', [AnggotaController::class, 'update'])->name('update');
        Route::delete('/{idanggota}', [AnggotaController::class, 'destroy'])->name('destroy');
    });

    // Rute resource untuk buku
    Route::resource('buku', BukuController::class);

    // Rute khusus untuk cetak laporan peminjaman (HARUS diletakkan sebelum resource peminjaman)
    Route::get('peminjaman/laporan', [PeminjamanController::class, 'laporan'])->name('peminjaman.laporan');

    // Rute resource untuk peminjaman
    Route::resource('peminjaman', PeminjamanController::class);
});

// Mengaktifkan semua route auth bawaan Laravel Breeze (login, register, dll)
require __DIR__.'/auth.php';
