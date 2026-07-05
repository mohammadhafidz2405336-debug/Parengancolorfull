<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ProfileDesaController;
use App\Http\Controllers\PotensiController;
use Illuminate\Support\Facades\Artisan;

// Route Halaman Publik Desa
Route::controller(DesaController::class)->group(function () {
    Route::get('/', 'home')->name('desa.home');
    Route::get('/profile-desa', 'profile')->name('desa.profile');
    Route::get('/potensi', 'potensi')->name('desa.potensi');
    Route::get('/pelayanan', 'pelayanan')->name('desa.pelayanan');
    Route::post('/pelayanan/kirim', 'kirimPermohonan')->name('surat.kirim');
    // Jalur berita publik dipindahkan ke BeritaController
});
Route::get('/berita', [BeritaController::class, 'index'])->name('desa.berita');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('desa.berita.show');

// Route Group Halaman Dashboard Admin
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Fitur Manajemen Berita (Menggunakan BeritaController)
    Route::get('/berita', [BeritaController::class, 'adminIndex'])->name('admin.berita.index');
    Route::get('/berita/tambah', [BeritaController::class, 'create'])->name('admin.berita.create');
    Route::post('/berita/simpan', [BeritaController::class, 'store'])->name('admin.berita.store');
    Route::put('/berita/{id}/update', [BeritaController::class, 'update'])->name('admin.berita.update');
    Route::delete('/berita/{id}/hapus', [BeritaController::class, 'destroy'])->name('admin.berita.destroy');
    Route::get('/berita/{id}/edit', [BeritaController::class, 'edit'])->name('admin.berita.edit');

    // Route untuk mengelola halaman profile desa
    Route::get('/profile-desa', [ProfileDesaController::class, 'index'])->name('admin.profile_desa.index');
    Route::post('/profile-desa/update', [ProfileDesaController::class, 'update'])->name('admin.profile_desa.update');   

    Route::get('/aparatur', [AdminController::class, 'aparaturIndex'])->name('admin.aparatur.index');
    Route::get('/aparatur/{id}/edit', [AdminController::class, 'aparaturEdit'])->name('admin.aparatur.edit');
    Route::post('/aparatur/{id}/update', [AdminController::class, 'aparaturUpdate'])->name('admin.aparatur.update');

    Route::get('/pelayanan', [AdminController::class, 'pelayananIndex'])->name('admin.pelayanan.index');
    Route::post('/pelayanan/{id}/verifikasi', [AdminController::class, 'pelayananUpdate'])->name('admin.pelayanan.update');
    Route::get('/pelayanan/{id}/detail', [AdminController::class, 'pelayananDetail'])->name('admin.pelayanan.detail');

   // Rute Tunggal Manajemen Potensi Terpadu
    Route::get('/potensi', [PotensiController::class, 'index'])->name('admin.potensi.index');
    Route::post('/potensi/unggulan/simpan', [PotensiController::class, 'saveUnggulan'])->name('admin.potensi.save_unggulan');
    Route::post('/potensi/umkm/simpan', [PotensiController::class, 'saveUmkm'])->name('admin.potensi.save_umkm');
    Route::delete('/potensi/{id}/hapus', [PotensiController::class, 'destroy'])->name('admin.potensi.destroy');


    // Manajemen Data Warga
    Route::get('/warga', [AdminController::class, 'wargaIndex'])->name('admin.warga.index');
    Route::post('/warga/import', [AdminController::class, 'wargaImport'])->name('admin.warga.import');
    Route::get('/warga/{id}/detail', [AdminController::class, 'wargaShow'])->name('admin.warga.detail');
});
