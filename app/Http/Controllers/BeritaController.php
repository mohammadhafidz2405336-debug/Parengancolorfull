<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    // Tampilan Berita untuk Publik/Warga
    public function index()
    {
        $allBerita = Berita::latest()->get();
        return view('berita', compact('allBerita'));
    }

    // Tampilan Daftar Berita di Dashboard Admin
    public function adminIndex()
    {
        $allBerita = Berita::latest()->get();
        return view('admin.berita_index', compact('allBerita'));
    }

    // Tampilan Form Tambah Berita di Admin
    public function create()
    {
        return view('admin.berita_create');
    }

    // Proses Simpan Berita Baru ke Database
    public function store(Request $request)
    {
        $request->validate([
            'judul'      => 'required|string|max:255',
            'kategori'   => 'required|string',
            'penulis'    => 'required|string|max:100',
            'gambar'     => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'isi_berita' => 'required|string',
        ]);

        // Proses upload gambar thumbnail ke folder storage/public/berita
       if ($request->hasFile('gambar')) {
            // Konfigurasi Cloudinary menggunakan URL dari environment variable
            Configuration::instance(env('CLOUDINARY_URL'));

            // Upload file
            $result = (new UploadApi())->upload($request->file('gambar')->getRealPath(), [
                'folder' => 'berita'
            ]);

            // Ambil URL aman
            $path = $result['secure_url']; 
        }

        Berita::create([
            'judul'      => $request->judul,
            'kategori'   => $request->kategori,
            'penulis'    => $request->penulis,
            'gambar'     => $path ?? null,
            'isi_berita' => $request->isi_berita,
        ]);

        return redirect()->route('admin.berita.index')
                         ->with('success', 'Berita berhasil dipublikasikan!');
    }

    // Proses Hapus Berita
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        
        $berita->delete();

        return redirect()->route('admin.berita.index')
                        ->with('success', 'Berita berhasil dihapus!');
    }

    // Tampilan Detail Berita Lengkap untuk Publik
    public function show($id)
    {
        // Mengambil data berita atau memunculkan error 404 jika tidak ditemukan
        $berita = Berita::findOrFail($id);
        
        // Opsional: Mengambil 3 berita terbaru lainnya untuk rekomendasi di bagian samping/bawah
        $beritaTerbaru = Berita::where('id', '!=', $id)->latest()->take(3)->get();

        return view('berita_detail', compact('berita', 'beritaTerbaru'));
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita_edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        // 1. Validasi (tambahkan semua field yang bisa diedit)
        $request->validate([
            'judul'      => 'required|string|max:255',
            'kategori'   => 'required|string',
            'penulis'    => 'required|string|max:100',
            'isi_berita' => 'required|string',
            'gambar'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. Update data dasar
        $berita->judul      = $request->judul;
        $berita->kategori   = $request->kategori;
        $berita->penulis    = $request->penulis;
        $berita->isi_berita = $request->isi_berita;

        // 3. Cek jika ada gambar baru
        if ($request->hasFile('gambar')) {
            \Cloudinary\Configuration\Configuration::instance(env('CLOUDINARY_URL'));
            $upload = (new \Cloudinary\Api\Upload\UploadApi())->upload($request->file('gambar')->getRealPath(), [
                'folder' => 'berita'
            ]);

            // LANGSUNG MASUKKAN KE OBJEK $berita
            $berita->gambar = $upload['secure_url'];
        }

        $berita->save();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diupdate!');
    }
}