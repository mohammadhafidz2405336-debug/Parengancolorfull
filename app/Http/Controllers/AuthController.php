<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login'); // Pastikan file blade ini ada[cite: 3]
    }

    public function login(Request $request) {
        // 1. Validasi input dari form (input form kamu bernama 'username')
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);

        // 2. Sesuaikan Auth::attempt
        // Kita beri tahu Laravel: "Cari kolom 'name' di database yang isinya sama dengan input 'username'"
        if (Auth::attempt([
            'name' => $credentials['username'], 
            'password' => $credentials['password']
        ])) {
            $request->session()->regenerate();
            return redirect()->intended('admin/dashboard');
        }

        // 3. Jika gagal, kembalikan error
        return back()->withErrors([
            'username' => 'Nama admin atau password salah.',
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }
}