<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\BeritaController; // Panggil Controller Baru
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
    Route::delete('/berita/{id}/hapus', [BeritaController::class, 'destroy'])->name('admin.berita.destroy');

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

Route::get('/jalankan-migrasi-seeder', function() {
    try {
        // Melakukan reset total database dan otomatis isi seeder dari cloud Railway
        Illuminate\Support\Facades\Artisan::call('migrate:fresh', [
            '--force' => true,
            '--seed' => true
        ]);
        
        return "Selamat! Database Railway berhasil di-RESET TOTAL (migrate:fresh) dan seeder sukses dimasukkan!";
    } catch (\Exception $e) {
        return "Gagal melakukan reset database: " . $e->getMessage();
    }
});