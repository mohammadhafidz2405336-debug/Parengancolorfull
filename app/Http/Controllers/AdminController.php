<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dasboard');
    }

    // Fungsi untuk menampilkan halaman daftar berita
    public function beritaIndex()
    {
        return view('admin.berita_index');
    }

    // Fungsi untuk menampilkan form tambah berita baru
    public function beritaCreate()
    {
        return view('admin.berita_create');
    }
    // Fungsi untuk menampilkan halaman form statistik kependudukan
    public function kependudukanIndex()
    {
        return view('admin.kependudukan_index');
    }

    // Fungsi untuk memproses update data statistik (untuk backend nanti)
    public function kependudukanUpdate(Request $request)
    {
        // Logika penyimpanan data ke database akan ditaruh di sini
        return redirect()->back()->with('success', 'Statistik kependudukan berhasil diperbarui!');
    }
    // Fungsi untuk menampilkan halaman daftar aparatur desa
    public function aparaturIndex()
    {
        return view('admin.aparatur_index');
    }

    // Fungsi untuk menampilkan form tambah/edit aparatur baru
    public function aparaturCreate()
    {
        return view('admin.aparatur_create');
    }
}