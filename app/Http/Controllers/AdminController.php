<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermohonanSurat;
use App\Models\Berita;
use App\Models\MasterWarga;
use App\Models\HomeSetting;
use Illuminate\Support\Facades\DB;      // <--- TAMBAHKAN BARIS INI
use Illuminate\Support\Facades\Storage;
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;
use App\Models\Aparatur;
use Illuminate\Support\Facades\Crypt;

class AdminController extends Controller
{
    public function index()
    {
        $totalPermohonan = PermohonanSurat::count();
        return view('admin.dasboard', compact('totalPermohonan'));
    }

    public function homeSettingEdit()
    {
        $setting = HomeSetting::first() ?? new HomeSetting();
        return view('admin.home_setting', compact('setting'));
    }

    // Proses Update / Simpan
    public function homeSettingUpdate(Request $request)
    {
        $setting = HomeSetting::first() ?? new HomeSetting();

        // Ambil data input teks selain token dan file
        $dataUpdate = $request->except(['_token', 'hero_images', 'kades_foto']);

        // Ambil array data gambar slider saat ini yang tersimpan di database
        $currentImages = is_array($setting->hero_images) ? $setting->hero_images : [];

        // === LOGIKA PER SLOT GAMBAR SLIDER ===
        if ($request->hasFile('hero_images')) {
            $uploadedSlots = $request->file('hero_images');

            foreach (['slot_1', 'slot_2', 'slot_3'] as $slot) {
                if (isset($uploadedSlots[$slot]) && $uploadedSlots[$slot]->isValid()) {
                    
                    // Cek apakah aplikasi berjalan di Production (Railway) dengan memanfaatkan env CLOUDINARY_URL
                    if (env('CLOUDINARY_URL')) {
                        
                        // 1. Inisialisasi Cloudinary SDK
                        Configuration::instance(env('CLOUDINARY_URL'));

                        // 2. Upload langsung ke Cloudinary ke dalam folder 'beranda/slider'
                        $upload = (new UploadApi())->upload($uploadedSlots[$slot]->getRealPath(), [
                            'folder' => 'beranda/slider'
                        ]);

                        // 3. Simpan URL penuh secure_url dari Cloudinary ke database
                        $currentImages[$slot] = $upload['secure_url'];

                    } else {
                        // JIKA DI LOKAL: Gunakan storage lokal bawaan
                        
                        // Hapus berkas lama yang ada di storage lokal khusus untuk slot ini
                        if (isset($currentImages[$slot]) && \Illuminate\Support\Facades\Storage::disk('public')->exists($currentImages[$slot])) {
                            \Illuminate\Support\Facades\Storage::disk('public')->delete($currentImages[$slot]);
                        }

                        // Simpan berkas gambar baru ke storage lokal
                        $path = $uploadedSlots[$slot]->store('beranda/slider', 'public');
                        
                        $currentImages[$slot] = $path;
                    }
                }
            }
        }
        
        // Satukan kembali array images yang diperbarui ke dalam dataUpdate
        $dataUpdate['hero_images'] = $currentImages;

        // === LOGIKA FOTO KADES ===
        if ($request->hasFile('kades_foto') && $request->file('kades_foto')->isValid()) {
            if (env('CLOUDINARY_URL')) {
                Configuration::instance(env('CLOUDINARY_URL'));
                $uploadKades = (new UploadApi())->upload($request->file('kades_foto')->getRealPath(), [
                    'folder' => 'beranda/kades'
                ]);
                $dataUpdate['kades_foto'] = $uploadKades['secure_url'];
            } else {
                if ($setting->kades_foto && \Illuminate\Support\Facades\Storage::disk('public')->exists($setting->kades_foto)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($setting->kades_foto);
                }
                $dataUpdate['kades_foto'] = $request->file('kades_foto')->store('beranda/kades', 'public');
            }
        }

        // Eksekusi update database
        $setting->fill($dataUpdate);
        $setting->save();

        return redirect()->back()->with('success', 'Pengaturan beranda berhasil diperbarui!');
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

    // Tambahkan di dalam class AdminController
    public function wargaIndex(Request $request)
    {
        // Mengambil query pencarian jika ada
        $search = $request->input('search');

        // Query data dengan pencarian dan pagination 20 per halaman
        $query = MasterWarga::latest();

        if ($search) {
            $query->where('nama', 'like', "%{$search}%")
                ->orWhere('nik_hash', '=', hash('sha256', $search)); 
        }

        $warga = $query->paginate(20);

        // Tetap kirim query search ke pagination agar saat pindah halaman search tetap terbawa
        $warga->appends(['search' => $search]);

        $warga->getCollection()->transform(function ($item) {
            $nikAsli = $item->nik; // Data sudah otomatis terdekripsi oleh model
            $item->nik_sensor = substr($nikAsli, 0, 4) . '********' . substr($nikAsli, -4);
            return $item;
        });

        return view('admin.warga_index', compact('warga'));
    }

    public function wargaImport(Request $request)
    {
        // Validasi file yang diupload harus berupa excel/csv
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        // TODO: Logika import Excel akan ditaruh di sini nantinya.
        
        return redirect()->back()->with('success', 'Fitur import Excel sedang dalam tahap pengembangan!');
    }

    public function wargaShow($id)
    {
        $warga = MasterWarga::findOrFail($id);

        // Langsung akses $warga->nik, otomatis terdekripsi
        return response()->json([
            'nama' => $warga->nama,
            'nik_asli' => $warga->nik, 
            'rt' => $warga->rt,
            'rw' => $warga->rw,
            'created_at' => $warga->created_at->format('d M Y')
        ]);
    }
}