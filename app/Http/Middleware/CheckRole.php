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
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/admin/login');
        }

        if (in_array(Auth::user()->role, $roles)) {
            return $next($request);
        }

        // Jika tidak punya akses, arahkan kembali dengan pesan error
        return redirect('/admin/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
    }
}
