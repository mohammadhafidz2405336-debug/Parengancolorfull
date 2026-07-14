<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermohonanSurat;
use App\Models\Berita;
use App\Models\MasterWarga;
use App\Models\HomeSetting;
use Illuminate\Support\Facades\DB;      
use Illuminate\Support\Facades\Storage;
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Support\Facades\Auth;
use App\Models\Aparatur;
use Illuminate\Support\Facades\Crypt;

class AdminController extends Controller
{
    public function index()
    {
        // Mengambil data riil dari database
        $totalBerita     = Berita::count(); //[cite: 3]
        $totalAparatur   = DB::table('aparatur_desa')->count(); //[cite: 3]
        $totalPermohonan = PermohonanSurat::count(); //[cite: 3]

        // Ambil data pertama dari tabel profile_desa[cite: 5]
        $profile = DB::table('profile_desa')->first();
        
        // GANTI KEMBALI MENJADI $totalPenduduk agar sesuai dengan file Blade Anda
        $totalPenduduk = $profile ? ($profile->jumlah_laki + $profile->jumlah_perempuan) : 0;

        // Mengambil 10 log aktivitas sistem terbaru untuk ditampilkan di dashboard[cite: 3]
        $activities = DB::table('activity_logs')
                        ->latest()
                        ->take(10)
                        ->get();

        // Pastikan di dalam compact menggunakan 'totalPenduduk'
        return view('admin.dasboard', compact('totalPenduduk', 'totalBerita', 'totalAparatur', 'totalPermohonan', 'activities')); //[cite: 3]
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

        // TAMBAHAN LOG: Mengubah Pengaturan Beranda
        DB::table('activity_logs')->insert([
            'user_id'     => Auth::id(),
            'description' => '<strong>' . Auth::user()->name . '</strong> baru saja memperbarui <span class="italic text-[#1A365D] font-medium">Pengaturan Beranda Desa</span>.',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        return redirect()->back()->with('success', 'Pengaturan beranda berhasil diperbarui!');
    }

    // ==========================================
    // MANAJEMEN PELAYANAN SURAT
    // ==========================================

    public function pelayananIndex()
    {
        $permohonan = PermohonanSurat::with('jenisSurat')->latest()->get();

        // TAMBAHAN LOG: Membuka Halaman Layanan Surat
        DB::table('activity_logs')->insert([
            'user_id'     => Auth::id(),
            'description' => '<strong>' . Auth::user()->name . '</strong> mengakses halaman panel <span class="font-medium text-blue-700">Permohonan Surat Warga</span>.',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        return view('admin.pelayanan_index', compact('permohonan'));
    }

    // Method untuk Detail (AJAX)
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

            // TAMBAHAN LOG: Membuka detail Surat (Melihat Data) via Ajax
            DB::table('activity_logs')->insert([
                'user_id'     => Auth::id(),
                'description' => '<strong>' . Auth::user()->name . '</strong> memeriksa dokumen detail permohonan surat Kode berkas: <span class="font-mono text-xs bg-slate-100 px-1 py-0.5 rounded">' . $permohonan->id . '</span>.',
                'created_at'  => now(),
                'updated_at'  => now()
            ]);

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

        // TAMBAHAN LOG: Mengubah / Memperbarui Status Surat
        DB::table('activity_logs')->insert([
            'user_id'     => Auth::id(),
            'description' => '<strong>' . Auth::user()->name . '</strong> mengubah status permohonan surat berkas #' . $id . ' menjadi <span class="uppercase font-bold text-blue-600">' . $request->status . '</span>.',
            'created_at'  => now(),
            'updated_at'  => now()
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

        // TAMBAHAN LOG: Membuka Manajemen Berita
        DB::table('activity_logs')->insert([
            'user_id'     => Auth::id(),
            'description' => '<strong>' . Auth::user()->name . '</strong> melihat daftar data pada halaman <span class="font-medium text-blue-700">Kelola Artikel Berita</span>.',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        return view('admin.berita_index', compact('berita'));
    }

    public function kependudukanUpdate(Request $request)
    {
        $request->validate([
            'jumlah_penduduk' => 'required|numeric',
            'jumlah_kk' => 'required|numeric'
        ]);

        // TAMBAHAN LOG: Mengupdate data manual statistik kependudukan
        DB::table('activity_logs')->insert([
            'user_id'     => Auth::id(),
            'description' => '<strong>' . Auth::user()->name . '</strong> memperbarui parameter konfigurasi data statistik manual kependudukan desa.',
            'created_at'  => now(),
            'updated_at'  => now()
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
        
        // TAMBAHAN LOG: Membuka Daftar Aparatur
        DB::table('activity_logs')->insert([
            'user_id'     => Auth::id(),
            'description' => '<strong>' . Auth::user()->name . '</strong> membuka dan memantau list data manajemen <span class="font-medium text-purple-700">Aparatur Desa</span>.',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

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

        // TAMBAHAN LOG: Mengubah Data Aparatur
        DB::table('activity_logs')->insert([
            'user_id'     => Auth::id(),
            'description' => '<strong>' . Auth::user()->name . '</strong> mengubah informasi profil staf Aparatur Desa atas nama <span class="font-semibold text-[#1A365D]">' . $request->nama . '</span>.',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

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

        // TAMBAHAN LOG: Membuka / Mencari Data Warga
        DB::table('activity_logs')->insert([
            'user_id'     => Auth::id(),
            'description' => '<strong>' . Auth::user()->name . '</strong> membuka modul <span class="font-medium text-blue-700">Data Kependudukan Warga</span>' . ($search ? ' dan melakukan pencarian kata kunci: "' . $search . '"' : '') . '.',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        return view('admin.warga_index', compact('warga'));
    }

    public function wargaImport(Request $request)
    {
        // Validasi file yang diupload harus berupa excel/csv
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        // TAMBAHAN LOG: Mencoba melakukan import data
        DB::table('activity_logs')->insert([
            'user_id'     => Auth::id(),
            'description' => '<strong>' . Auth::user()->name . '</strong> memicu sistem untuk mengunggah dokumen import excel eksternal data warga.',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // TODO: Logika import Excel akan ditaruh di sini nantinya.
        
        return redirect()->back()->with('success', 'Fitur import Excel sedang dalam tahap pengembangan!');
    }
    
    public function wargaStore(Request $request)
    {
        $request->validate([
            'nik'  => 'required|numeric|digits:16',
            'nama' => 'required|string|max:255',
            'rt'   => 'required|string|max:10',
            'rw'   => 'required|string|max:10',
        ]);

        // Buat hash untuk pengecekan blind index
        $nikHash = hash('sha256', $request->nik);
        
        // Cek apakah NIK sudah terdaftar
        $exists = MasterWarga::where('nik_hash', $nikHash)->exists();
        if ($exists) {
            return redirect()->back()->with('error', 'Gagal! NIK tersebut sudah terdaftar di sistem.')->withInput();
        }

        // Simpan data
        $warga = new MasterWarga();
        $warga->nik_hash = $nikHash;
        $warga->nik = $request->nik; // Asumsi mutator di model otomatis melakukan enkripsi
        $warga->nama = $request->nama;
        $warga->rt = $request->rt;
        $warga->rw = $request->rw;
        $warga->save();

        // Tambahan LOG
        DB::table('activity_logs')->insert([
            'user_id'     => Auth::id(),
            'description' => '<strong>' . Auth::user()->name . '</strong> menambahkan data warga baru secara manual atas nama <span class="font-semibold">' . $warga->nama . '</span>.',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        return redirect()->back()->with('success', 'Data warga berhasil ditambahkan!');
    }

    public function wargaShow($id)
    {
        $warga = MasterWarga::findOrFail($id);

        // TAMBAHAN LOG: Melihat detail data warga via Ajax Modal
        DB::table('activity_logs')->insert([
            'user_id'     => Auth::id(),
            'description' => '<strong>' . Auth::user()->name . '</strong> membuka pop-up modal detail kependudukan riil milik warga bernama <span class="font-semibold">' . $warga->nama . '</span>.',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

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