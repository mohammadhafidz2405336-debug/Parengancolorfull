<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
   // Di dalam CheckRole.php
    // di dalam file CheckRole.php
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            // Jika belum login sama sekali, lempar ke login dengan pesan eror
            return redirect('/admin/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if (in_array(Auth::user()->role, $roles)) {
            return $next($request);
        }

        // JIKA GAGAL PINDAH HALAMAN KARENA ROLE TIDAK COCOK:
        // Kirim pesan error spesifik yang mencantumkan Role user saat ini vs Role yang dibutuhkan
        $userRole = Auth::user()->role ?? 'Tidak ada Role';
        $requiredRoles = implode(', ', $roles);
        
        return redirect('/admin/dashboard')->with('error', "Akses Ditolak! Role Anda adalah [{$userRole}], sedangkan halaman ini memerlukan role: [{$requiredRoles}].");
    }
}
