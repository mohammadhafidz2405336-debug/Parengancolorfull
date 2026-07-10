<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\PermohonanSurat;
use App\Models\Berita;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 💡 PERBAIKAN: Ubah dari 'admin' menjadi 'layouts.admin' sesuai struktur folder kamu
        View::composer('layouts.admin', function ($view) {
            
            // 1. Ambil permohonan surat baru yang statusnya masih 'pending'
            $latestSuratNotif = PermohonanSurat::where('status', 'pending')
                                ->latest()
                                ->take(5)
                                ->get();
            $unreadSuratCount = PermohonanSurat::where('status', 'pending')->count();

            // 2. Ambil berita yang baru saja diterbitkan
            $latestBeritaNotif = Berita::latest()
                                ->take(5)
                                ->get();
            $newBeritaCount   = Berita::where('created_at', '>=', now()->subDays(3))->count();

            // Kirim variabel-variabel ke dalam layout admin secara global
            $view->with([
                'latestSuratNotif'  => $latestSuratNotif,
                'unreadSuratCount'  => $unreadSuratCount,
                'latestBeritaNotif' => $latestBeritaNotif,
                'newBeritaCount'    => $newBeritaCount,
            ]);
        });
    }
}