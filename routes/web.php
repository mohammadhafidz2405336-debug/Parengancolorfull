<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ProfileDesaController;
use App\Http\Controllers\PotensiController;
use App\Http\Controllers\ChatAiController;
use App\Http\Controllers\AuthController;
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
Route::post('/chat-ai', [App\Http\Controllers\ChatAiController::class, 'sendMessage'])->name('chat.ai');
Route::post('/chat-ai/kirim', [ChatAiController::class, 'sendMessage'])->name('chat.ai.send');

Route::get('/berita', [BeritaController::class, 'index'])->name('desa.berita');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('desa.berita.show');

Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Route Group Halaman Dashboard Admin
Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    // Semua role yang login bisa masuk dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // === HANYA UNTUK KARANG TARUNA, PKK, ADMIN UTAMA, & PERANGKAT DESA ===
    Route::middleware(['role:admin_utama,perangkat_desa,karang_taruna,pkk'])->group(function () {
        // Fitur Manajemen Berita
        Route::get('/berita', [BeritaController::class, 'adminIndex'])->name('admin.berita.index');
        Route::get('/berita/tambah', [BeritaController::class, 'create'])->name('admin.berita.create');
        Route::post('/berita/simpan', [BeritaController::class, 'store'])->name('admin.berita.store');
        Route::put('/berita/{id}/update', [BeritaController::class, 'update'])->name('admin.berita.update');
        Route::delete('/berita/{id}/hapus', [BeritaController::class, 'destroy'])->name('admin.berita.destroy');
        Route::get('/berita/{id}/edit', [BeritaController::class, 'edit'])->name('admin.berita.edit');
    });

    // === HANYA UNTUK ADMIN UTAMA & PERANGKAT DESA ===
    Route::middleware(['role:admin_utama,perangkat_desa'])->group(function () {
        // Manajemen Konten Beranda
        Route::get('/home-setting', [AdminController::class, 'homeSettingEdit'])->name('admin.home_setting.edit');
        Route::post('/home-setting/update', [AdminController::class, 'homeSettingUpdate'])->name('admin.home_setting.update');
        
        // Halaman profile desa
        Route::get('/profile-desa', [ProfileDesaController::class, 'index'])->name('admin.profile_desa.index');
        Route::post('/profile-desa/update', [ProfileDesaController::class, 'update'])->name('admin.profile_desa.update');   

        // Aparatur
        Route::get('/aparatur', [AdminController::class, 'aparaturIndex'])->name('admin.aparatur.index');
        Route::get('/aparatur/{id}/edit', [AdminController::class, 'aparaturEdit'])->name('admin.aparatur.edit');
        Route::post('/aparatur/{id}/update', [AdminController::class, 'aparaturUpdate'])->name('admin.aparatur.update');

        // Pelayanan
        Route::get('/pelayanan', [AdminController::class, 'pelayananIndex'])->name('admin.pelayanan.index');
        Route::post('/pelayanan/{id}/verifikasi', [AdminController::class, 'pelayananUpdate'])->name('admin.pelayanan.update');
        Route::get('/pelayanan/{id}/detail', [AdminController::class, 'pelayananDetail'])->name('admin.pelayanan.detail');

        // Manajemen Potensi
        Route::get('/potensi', [PotensiController::class, 'index'])->name('admin.potensi.index');
        Route::post('/potensi/unggulan/simpan', [PotensiController::class, 'saveUnggulan'])->name('admin.potensi.save_unggulan');
        Route::post('/potensi/umkm/simpan', [PotensiController::class, 'saveUmkm'])->name('admin.potensi.save_umkm');
        Route::delete('/potensi/{id}/hapus', [PotensiController::class, 'destroy'])->name('admin.potensi.destroy');

        // Manajemen Data Warga
        Route::get('/warga', [AdminController::class, 'wargaIndex'])->name('admin.warga.index');
        Route::post('/warga/import', [AdminController::class, 'wargaImport'])->name('admin.warga.import');
        Route::post('/warga/simpan', [AdminController::class, 'wargaStore'])->name('admin.warga.store');
        Route::get('/warga/{id}/detail', [AdminController::class, 'wargaShow'])->name('admin.warga.detail');
    });
});
