<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\AdminController; // Tambahkan ini

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
});