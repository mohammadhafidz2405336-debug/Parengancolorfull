<?php

namespace App\Http\Controllers;

use App\Models\PotensiUmkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PotensiController extends Controller
{
    private function initCloudinary()
    {
        Configuration::instance(env('CLOUDINARY_URL'));
    }

    // Mengakses satu halaman utama yang berisi semua form dan tabel
    public function index(Request $request)
    {
        // Ambil data potensi unggulan khusus untuk slot kiri dan kanan
        $unggulanKiri = PotensiUmkm::where('jenis', 'unggulan')->where('lokasi', 'kiri')->first();
        $unggulanKanan = PotensiUmkm::where('jenis', 'unggulan')->where('lokasi', 'kanan')->first();

        // Ambil list data UMKM warga untuk tabel direktori bawah
        $umkmList = PotensiUmkm::where('jenis', 'umkm')->latest()->get();

        $umkmEdit = null;
        if ($request->has('edit_umkm_id')) {
            $umkmEdit = PotensiUmkm::find($request->edit_umkm_id);
        }

        return view('admin.potensi_index', compact('unggulanKiri', 'unggulanKanan', 'umkmList', 'umkmEdit'));
    }

    // Menyimpan atau Memperbarui Potensi Unggulan Desa (Teks Cerita & Foto)
    public function saveUnggulan(Request $request)
    {
        $request->validate([
            'slot' => 'required|in:kiri,kanan',
            'nama' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $slot = $request->input('slot');
        
        // Cari data unggulan lama
        $unggulan = PotensiUmkm::where('jenis', 'unggulan')->where('lokasi', $slot)->first();

        $data = [
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'jenis' => 'unggulan',
            'lokasi' => $slot, // Pastikan kolom lokasi tersimpan
        ];

        if ($request->hasFile('foto')) {
            // Konfigurasi Cloudinary
            Configuration::instance(env('CLOUDINARY_URL'));

            // Upload file baru ke Cloudinary
            $upload = (new UploadApi())->upload($request->file('foto')->getRealPath(), [
                'folder' => 'potensi_desa'
            ]);

            // Masukkan URL aman dari Cloudinary ke database
            $data['foto'] = $upload['secure_url'];
        }

        // Simpan ke database
        PotensiUmkm::updateOrCreate(
            ['jenis' => 'unggulan', 'lokasi' => $slot],
            $data
        );

        DB::table('activity_logs')->insert([
            'user_id'     => Auth::id(),
            'description' => '<strong>' . Auth::user()->name . '</strong> memperbarui Potensi Unggulan Sisi ' . ucfirst($slot) . ': <span class="font-medium text-emerald-700">' . $request->nama . '</span>.',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        return redirect()->route('admin.potensi.index')
                        ->with('success', "Template Potensi Unggulan Sisi " . ucfirst($slot) . " berhasil diperbarui!");
    }

    // Menyimpan UMKM Baru atau Update UMKM yang sudah ada
    public function saveUmkm(Request $request)
    {
        $request->validate([
            'umkm_id' => 'nullable|exists:potensi_umkm,id',
            'nama' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'pemilik' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'koordinat' => 'nullable|string',
            'kontak' => 'required|string|max:20',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $id = $request->input('umkm_id');
        $data = $request->except(['foto']);
        
        $data['jenis'] = 'umkm';

        if ($request->hasFile('foto')) {
            $this->initCloudinary();
            // Upload ke Cloudinary
            $upload = (new UploadApi())->upload($request->file('foto')->getRealPath(), [
                'folder' => 'potensi_desa'
            ]);
            // Simpan URL dari Cloudinary ke database
            $data['foto'] = $upload['secure_url']; 
        }

        if ($id) {
            $umkm = PotensiUmkm::findOrFail($id);
            $umkm->update($data);
            $aksi = 'memperbarui data';
        } else {
            PotensiUmkm::create($data);
            $aksi = 'menambahkan profil';
        }

        // TAMBAHAN LOG: Simpan/Update UMKM
        DB::table('activity_logs')->insert([
            'user_id'     => Auth::id(),
            'description' => '<strong>' . Auth::user()->name . '</strong> baru saja ' . $aksi . ' UMKM <span class="font-medium text-indigo-700">' . $request->nama . '</span>.',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        return redirect()->route('admin.potensi.index')->with('success', 'Data UMKM berhasil disimpan!');
    }

    // Menghapus data UMKM
    public function destroy($id)
    {
        $potensi = PotensiUmkm::findOrFail($id);
        if ($potensi->foto && Storage::disk('public')->exists($potensi->foto)) {
            Storage::disk('public')->delete($potensi->foto);
        }
        $potensi->delete();
        
        DB::table('activity_logs')->insert([
            'user_id'     => Auth::id(),
            'description' => '<strong>' . Auth::user()->name . '</strong> menghapus data UMKM/Potensi: <span class="font-medium text-red-600">' . $namaPotensi . '</span>.',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        return redirect()->route('admin.potensi.index')->with('success', 'Data berhasil dihapus!');
    }
}