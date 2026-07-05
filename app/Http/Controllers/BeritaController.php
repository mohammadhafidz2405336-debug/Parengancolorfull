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
        // Mengambil berita terbaru dengan batasan 6 per halaman
        $allBerita = Berita::latest()->paginate(6); 
        
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
        // 1. Validasi
        $request->validate([
            'judul'      => 'required|string|max:255',
            'kategori'   => 'required|string',
            'instansi'   => 'required|string|max:100',
            'pewarta'    => 'required|string|max:100',
            'gambar'     => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'isi_berita' => 'required|string',
        ]);

        // 2. Upload gambar ke Cloudinary
        $path = null; 
        if ($request->hasFile('gambar')) {
            Configuration::instance(env('CLOUDINARY_URL'));

            $upload = (new UploadApi())->upload($request->file('gambar')->getRealPath(), [
                'folder' => 'berita'
            ]);

            // SIMPAN KE VARIABEL $path, BUKAN $berita->gambar
            $path = $upload['secure_url']; 
        }

        // 3. Simpan ke database
        Berita::create([
            'judul'      => $request->judul,
            'kategori'   => $request->kategori,
            'instansi'   => $request->instansi,
            'pewarta'    => $request->pewarta,
            'gambar'     => $path, // Gunakan variabel $path di sini
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

        // 1. Validasi: Update nama field 'penulis' menjadi 'pewarta'
        // Tambahkan juga validasi untuk 'instansi'
        $request->validate([
            'judul'      => 'required|string|max:255',
            'kategori'   => 'required|string',
            'instansi'   => 'required|string|max:100', // Wajib ada
            'pewarta'    => 'required|string|max:100', // Ganti dari penulis ke pewarta
            'isi_berita' => 'required|string',
            'gambar'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. Update data: Sesuaikan dengan nama kolom yang baru
        $berita->judul      = $request->judul;
        $berita->kategori   = $request->kategori;
        $berita->instansi   = $request->instansi; // Field baru
        $berita->pewarta    = $request->pewarta;  // Field yang di-rename
        $berita->isi_berita = $request->isi_berita;

        // 3. Cek jika ada gambar baru
        if ($request->hasFile('gambar')) {
            Configuration::instance(env('CLOUDINARY_URL')); // Sudah ringkas karena ada 'use' di atas

            $upload = (new UploadApi())->upload($request->file('gambar')->getRealPath(), [
                'folder' => 'berita'
            ]);

            $berita->gambar = $upload['secure_url']; // Untuk fungsi update
            // Atau $path = $upload['secure_url'];  // Untuk fungsi store
        }

        $berita->save();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diupdate!');
    }
}