<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DesaController;

/*
|--------------------------------------------------------------------------
| Web Routes - Website Resmi Desa Parengan
|--------------------------------------------------------------------------
*/

// Route Group untuk mempermudah pengelolaan halaman publik desa
Route::controller(DesaController::class)->group(function () {
    Route::get('/', 'home')->name('desa.home');
    Route::get('/profile-desa', 'profile')->name('desa.profile');
    Route::get('/potensi', 'potensi')->name('desa.potensi');
    Route::get('/pelayanan', 'pelayanan')->name('desa.pelayanan');
    Route::get('/berita', 'berita')->name('desa.berita');
});