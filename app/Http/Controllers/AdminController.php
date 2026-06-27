<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermohonanSurat;
use App\Models\Berita;
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
    public function aparaturIndex() { return view('admin.aparatur_index'); }
    public function aparaturCreate() { return view('admin.aparatur_create'); }
    public function potensiIndex() { return view('admin.potensi_index'); }
}