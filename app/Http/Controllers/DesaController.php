<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DesaController extends Controller
{
    // Halaman Beranda (Home)
    public function home()
    {
        return view('home');
    }

    // Halaman Profil Desa
    public function profile()
    {
        return view('profile');
    }

    // Halaman Potensi (UMKM, Pertanian, dll)
    public function potensi()
    {
        return view('potensi');
    }

    // Halaman Layanan Publik / Administrasi
    public function pelayanan()
    {
        return view('pelayanan');
    }

    // Halaman Berita & Artikel Desa
    public function berita()
    {
        return view('berita');
    }

    // Halaman Kontak & Pengaduan
    public function contact()
    {
        return view('contact');
    }
}