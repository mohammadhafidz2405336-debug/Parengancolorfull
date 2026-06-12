<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\AdminController; // Tambahkan ini
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes - Website Resmi Desa Parengan
|--------------------------------------------------------------------------
*/

// Route Halaman Publik Desa
Route::controller(DesaController::class)->group(function () {
    Route::get('/', 'home')->name('desa.home');
    Route::get('/profile-desa', 'profile')->name('desa.profile');
    Route::get('/potensi', 'potensi')->name('desa.potensi');
    Route::get('/pelayanan', 'pelayanan')->name('desa.pelayanan');
    Route::post('/pelayanan/kirim', 'kirimPermohonan')->name('surat.kirim');
    Route::get('/berita', 'berita')->name('desa.berita');
});

// Route Group Halaman Dashboard Admin
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Tambahkan dua route ini untuk mengelola berita
    Route::get('/berita', [AdminController::class, 'beritaIndex'])->name('admin.berita.index');
    Route::get('/berita/tambah', [AdminController::class, 'beritaCreate'])->name('admin.berita.create');
    // Route untuk mengelola data kependudukan
    Route::get('/kependudukan', [AdminController::class, 'kependudukanIndex'])->name('admin.kependudukan.index');
    Route::post('/kependudukan/update', [AdminController::class, 'kependudukanUpdate'])->name('admin.kependudukan.update');

    Route::get('/aparatur', [AdminController::class, 'aparaturIndex'])->name('admin.aparatur.index');
    Route::get('/aparatur/tambah', [AdminController::class, 'aparaturCreate'])->name('admin.aparatur.create');

    Route::get('/pelayanan', [AdminController::class, 'pelayananIndex'])->name('admin.pelayanan.index');
    Route::post('/pelayanan/{id}/verifikasi', [AdminController::class, 'pelayananUpdate'])->name('admin.pelayanan.update');
    Route::get('/pelayanan/{id}/detail', [AdminController::class, 'pelayananDetail'])->name('admin.pelayanan.detail');

    Route::get('/potensi', [AdminController::class, 'potensiIndex'])->name('admin.potensi.index');
});

Route::get('/jalankan-migrasi-desa', function() {
    try {
        Artisan::call('migrate', ['--force' => true]);
        return "Selamat! Semua tabel database berhasil dibuat di Railway.";
    } catch (\Exception $e) {
        return "Gagal migrasi: " . $e->getMessage();
    }
});