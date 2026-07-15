<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\PermohonanSurat;
use App\Models\Berita;
use Illuminate\Support\Facades\URL;

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
        // Hanya paksa HTTPS jika aplikasi berjalan di server (production)
        // Ini mencegah error saat Anda mengembangkan aplikasi di laptop (local)
        if ($this->app->environment('production')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // View composer
        View::composer('layouts.admin', function ($view) {
            // 1. Ambil permohonan surat
            $latestSuratNotif = PermohonanSurat::where('status', 'pending')
                                ->latest()
                                ->take(5)
                                ->get();
            $unreadSuratCount = PermohonanSurat::where('status', 'pending')->count();

            // 2. Ambil berita
            $latestBeritaNotif = Berita::latest()
                                ->take(5)
                                ->get();
            $newBeritaCount = Berita::where('created_at', '>=', now()->subDays(3))->count();

            $view->with([
                'latestSuratNotif'  => $latestSuratNotif,
                'unreadSuratCount'  => $unreadSuratCount,
                'latestBeritaNotif' => $latestBeritaNotif,
                'newBeritaCount'    => $newBeritaCount,
            ]);
        });
    }
}