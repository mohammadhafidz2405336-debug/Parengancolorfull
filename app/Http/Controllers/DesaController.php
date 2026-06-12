<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MasterJenisSurat;
use App\Models\MasterWarga;
use App\Models\PermohonanSurat;
use Illuminate\Support\Facades\Crypt;

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
        // Mengambil semua data master jenis surat
        $listSurat = DB::table('master_jenis_surat')->get(); 

        // Kirim variabel $listSurat ke file blade
        return view('pelayanan', compact('listSurat'));
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

    // METHOD PERBAIKAN: Memproses kiriman formulir permohonan surat dari warga
    public function kirimPermohonan(Request $request)
    {
        // 1. Validasi Input Utama
        $request->validate([
            'nik'            => 'required|numeric|digits:16',
            'nama'           => 'required|string|max:255',
            'telepon'        => 'required|numeric',
            'keperluan'      => 'required|string',
            'jenis_surat_id' => 'required|exists:master_jenis_surat,id',
            // Validasi untuk input tambahan dan file (opsional)
            'tambahan'       => 'nullable|array',
            'tambahan_file'  => 'nullable|array',
            'tambahan_file.*'=> 'file|mimes:jpeg,png,jpg,pdf|max:2048', // Maks 2MB
        ]);

        // 2. Cari jenis surat
        $jenisSurat = MasterJenisSurat::findOrFail($request->jenis_surat_id);

        // 3. Validasi Kependudukan
        $nikHashInput = hash('sha256', $request->nik);
        $wargaSah = MasterWarga::where('nik_hash', $nikHashInput)->first();

        if (!$wargaSah || strtolower(trim($request->nama)) !== strtolower(trim($wargaSah->nama))) {
            return redirect()->back()->withErrors(['nik' => 'Data NIK atau Nama tidak sesuai dengan data kependudukan desa.'])->withInput();
        }

        // 4. Proses Penggabungan Data Input
        $syaratTambahan = $request->input('tambahan', []);

        // Proses Upload File jika ada
        if ($request->hasFile('tambahan_file')) {
            foreach ($request->file('tambahan_file') as $namaKey => $file) {
                // Simpan ke storage/app/public/syarat_surat
                $path = $file->store('syarat_surat', 'public');
                $syaratTambahan[$namaKey] = $path; // Simpan path ke JSON
            }
        }

        // 5. Menyusun Data ke format JSON
        $dataInput = [
            'nik_terenkripsi' => Crypt::encryptString($request->nik),
            'nama_pemohon'    => $request->nama,
            'no_hp'           => $request->telepon,
            'keperluan'       => $request->keperluan,
            'rt'              => $wargaSah->rt,
            'rw'              => $wargaSah->rw,
            'syarat_tambahan' => $syaratTambahan // Semua teks, tanggal, & path file masuk sini
        ];

        // 6. Simpan ke database
        PermohonanSurat::create([
            'admin_id'       => null,
            'jenis_surat_id' => $jenisSurat->id,
            'nik_hash'       => $nikHashInput,
            'data_input'     => $dataInput,
            'status'         => 'pending'
        ]);

        return redirect()->back()->with('success', 'Permohonan surat berhasil dikirim! Silakan tunggu konfirmasi perangkat desa.');
    }
}