<?php

namespace App\Http\Controllers;

use App\Models\PotensiUmkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PotensiController extends Controller
{
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
        
        // Cari data unggulan lama pada slot ini
        $unggulan = PotensiUmkm::where('jenis', 'unggulan')->where('lokasi', $slot)->first();

        $data = [
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'jenis' => 'unggulan',
        ];

        if ($request->hasFile('foto')) {
            if ($unggulan && $unggulan->foto && \Storage::disk('public')->exists($unggulan->foto)) {
                \Storage::disk('public')->delete($unggulan->foto);
            }
            $data['foto'] = $request->file('foto')->store('potensi', 'public');
        }

        // Kunci update data berdasarkan jenis 'unggulan' dan slot 'lokasi' (kiri/kanan)
        PotensiUmkm::updateOrCreate(
            ['jenis' => 'unggulan', 'lokasi' => $slot],
            $data
        );

        return redirect()->route('admin.potensi.index')->with('success', "Template Potensi Unggulan Sisi " . ucfirst($slot) . " berhasil diperbarui!");
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
        $data = $request->all();
        $data['jenis'] = 'umkm';

        if ($id) {
            // Proses Update UMKM
            $umkm = PotensiUmkm::findOrFail($id);
            if ($request->hasFile('foto')) {
                if ($umkm->foto && Storage::disk('public')->exists($umkm->foto)) {
                    Storage::disk('public')->delete($umkm->foto);
                }
                $data['foto'] = $request->file('foto')->store('potensi', 'public');
            }
            $umkm->update($data);
            $msg = 'Data UMKM berhasil diperbarui!';
        } else {
            // Proses Tambah UMKM Baru
            if ($request->hasFile('foto')) {
                $data['foto'] = $request->file('foto')->store('potensi', 'public');
            }
            PotensiUmkm::create($data);
            $msg = 'UMKM baru berhasil didaftarkan!';
        }

        return redirect()->route('admin.potensi.index')->with('success', $msg);
    }

    // Menghapus data UMKM
    public function destroy($id)
    {
        $potensi = PotensiUmkm::findOrFail($id);
        if ($potensi->foto && Storage::disk('public')->exists($potensi->foto)) {
            Storage::disk('public')->delete($potensi->foto);
        }
        $potensi->delete();

        return redirect()->route('admin.potensi.index')->with('success', 'Data berhasil dihapus!');
    }
}