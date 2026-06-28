<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermohonanSurat;
use App\Models\Berita;
use Illuminate\Support\Facades\DB;      // <--- TAMBAHKAN BARIS INI
use Illuminate\Support\Facades\Storage;
use App\Models\Aparatur;
use Illuminate\Support\Facades\Crypt;

class AdminController extends Controller
{
    public function index()
    {
        $totalPermohonan = PermohonanSurat::count();
        return view('admin.dasboard', compact('totalPermohonan'));
    }

    // ==========================================
    // MANAJEMEN PELAYANAN SURAT
    // ==========================================

    public function pelayananIndex()
    {
        $permohonan = PermohonanSurat::with('jenisSurat')->latest()->get();
        return view('admin.pelayanan_index', compact('permohonan'));
    }

    // Method untuk Detail (AJAX) - Tanpa Logging untuk saat ini
    public function pelayananDetail($id)
    {
        try {
            $permohonan = PermohonanSurat::with('jenisSurat')->findOrFail($id);
            
            // Dekripsi NIK
            $data = $permohonan->data_input;
            $nikMentah = $data['nik_terenkripsi'] ?? null;
            $nikAsli = 'Data tidak ditemukan';

            if ($nikMentah) {
                try {
                    $nikAsli = Crypt::decryptString($nikMentah);
                } catch (\Exception $e) {
                    $nikAsli = 'Error Dekripsi';
                }
            }

            return response()->json([
                'status'   => 'success',
                'data'     => $permohonan,
                'nik_asli' => $nikAsli,
                'storage_url' => asset('storage')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Terjadi kesalahan sistem'
            ], 500);
        }
    }

    public function pelayananUpdate(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,selesai,ditolak',
            'keterangan_admin' => 'nullable|string|max:500'
        ]);

        $surat = PermohonanSurat::findOrFail($id);
        $surat->update([
            'status' => $request->status,
            'keterangan_admin' => $request->keterangan_admin,
        ]);

        return redirect()->route('admin.pelayanan.index')
                         ->with('success', 'Status berhasil diperbarui ke: ' . ucfirst($request->status));
    }

    // ==========================================
    // FITUR LAIN
    // ==========================================

    public function beritaIndex()
    {
        $berita = Berita::latest()->get();
        return view('admin.berita_index', compact('berita'));
    }

    public function kependudukanUpdate(Request $request)
    {
        $request->validate([
            'jumlah_penduduk' => 'required|numeric',
            'jumlah_kk' => 'required|numeric'
        ]);
        return redirect()->back()->with('success', 'Data statistik berhasil diperbarui!');
    }

    public function beritaCreate() { return view('admin.berita_create'); }
    public function kependudukanIndex() { return view('admin.kependudukan_index'); }
    public function potensiIndex() { return view('admin.potensi_index'); }
    
    public function aparaturIndex() 
    { 
        // 1. Ambil data dari tabel aparatur_desa
        $aparatur = \DB::table('aparatur_desa')->get(); 
        
        // 2. Kirim variabel $aparatur ke dalam file blade index
        return view('admin.aparatur_index', compact('aparatur')); 
    }

    public function aparaturEdit($id)
    {
        // Ambil data perangkat berdasarkan ID dari tabel aparatur_desa
        $perangkat = \DB::table('aparatur_desa')->where('id', $id)->first();
        
        if (!$perangkat) {
            return redirect()->route('admin.aparatur.index')->with('error', 'Data tidak ditemukan!');
        }

        return view('admin.aparatur_edit', compact('perangkat'));
    }

    public function aparaturUpdate(Request $request, $id)
    {
        // Validasi input data
        $request->validate([
            'nama'          => 'required|string|max:255',
            'email'         => 'nullable|string|max:255',
            'jam_pelayanan' => 'nullable|string|max:255',
            'tupoksi'       => 'nullable|string',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Ambil data lama perangkat desa
        $perangkat = DB::table('aparatur_desa')->where('id', $id)->first();
        
        if (!$perangkat) {
            return redirect()->route('admin.aparatur.index')->with('error', 'Data tidak ditemukan!');
        }

        $dataUpdate = [
            'nama'          => $request->nama,
            'email'         => $request->email,
            'jam_pelayanan' => $request->jam_pelayanan,
            'tupoksi'       => $request->tupoksi,
            'updated_at'    => now(),
        ];

        // Jika ada upload foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada di storage
            if ($perangkat->foto && Storage::disk('public')->exists($perangkat->foto)) {
                Storage::disk('public')->delete($perangkat->foto);
            }

            // Simpan foto baru ke folder storage/app/public/aparatur
            $path = $request->file('foto')->store('aparatur', 'public');
            $dataUpdate['foto'] = $path;
        }

        // Eksekusi update ke database
        DB::table('aparatur_desa')->where('id', $id)->update($dataUpdate);

        return redirect()->route('admin.aparatur.index')->with('success', 'Data aparatur berhasil diperbarui!');
    }
}