<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Support\Facades\Auth;

class ProfileDesaController extends Controller
{
    /**
     * Menampilkan halaman form kelola profil desa terintegrasi.
     */
    public function index()
    {
        // Ambil data pertama dari tabel profile_desa
        $profile = DB::table('profile_desa')->first();

        // Jika data masih kosong (belum ada record sama sekali), buatkan baris default agar tidak error
        if (!$profile) {
            DB::table('profile_desa')->insert([
                'nama_desa' => 'Desa Parengan',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $profile = DB::table('profile_desa')->first();
        }

        return view('admin.profile_desa_index', compact('profile'));
    }

    /**
     * Memproses pembaruan seluruh data profil, visi misi, dan kependudukan.
     */
    public function update(Request $request)
    {
        // Validasi input data dari form admin
        $request->validate([
            'deskripsi_umum'     => 'required|string',
            'foto_utama'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'visi'               => 'required|string',
            'misi'               => 'required|string',
            'jumlah_laki'        => 'required|numeric|min:0',
            'jumlah_perempuan'   => 'required|numeric|min:0',
            'total_kk'           => 'required|numeric|min:0',
            'agama_islam'        => 'required|numeric|min:0',
            'agama_kristen'      => 'required|numeric|min:0',
            'agama_katolik'      => 'required|numeric|min:0',
            'agama_lainnya'      => 'required|numeric|min:0',
            'pndk_belum_sekolah' => 'required|numeric|min:0',
            'pndk_sd'            => 'required|numeric|min:0',
            'pndk_smp'           => 'required|numeric|min:0',
            'pndk_sma'           => 'required|numeric|min:0',
            'pndk_sarjana'       => 'required|numeric|min:0',
            'umur_anak'          => 'required|numeric|min:0',
            'umur_produktif'     => 'required|numeric|min:0',
            'umur_lansia'        => 'required|numeric|min:0',
        ]);

        $profile = DB::table('profile_desa')->first();

        // Siapkan array data yang akan diperbarui
        $dataUpdate = [
            'deskripsi_umum'     => $request->deskripsi_umum,
            'visi'               => $request->visi,
            'misi'               => $request->misi,
            'jumlah_laki'        => $request->jumlah_laki,
            'jumlah_perempuan'   => $request->jumlah_perempuan,
            'total_kk'           => $request->total_kk,
            'agama_islam'        => $request->agama_islam,
            'agama_kristen'      => $request->agama_kristen,
            'agama_katolik'      => $request->agama_katolik,
            'agama_lainnya'      => $request->agama_lainnya,
            'pndk_belum_sekolah' => $request->pndk_belum_sekolah,
            'pndk_sd'            => $request->pndk_sd,
            'pndk_smp'           => $request->pndk_smp,
            'pndk_sma'           => $request->pndk_sma,
            'pndk_sarjana'       => $request->pndk_sarjana,
            'umur_anak'          => $request->umur_anak,
            'umur_produktif'     => $request->umur_produktif,
            'umur_lansia'        => $request->umur_lansia,
            'updated_at'         => now(),
        ];

        // Logika penanganan upload file gambar foto utama banner jika ada berkas masuk
        if ($request->hasFile('foto_utama')) {
            
            if (env('CLOUDINARY_URL')) {
                // 1. JIKA DI RAILWAY (Menggunakan Cloudinary)
                Configuration::instance(env('CLOUDINARY_URL'));
                
                $upload = (new UploadApi())->upload($request->file('foto_utama')->getRealPath(), [
                    'folder' => 'profile_desa'
                ]);
                
                // Simpan URL aman dari Cloudinary ke database
                $dataUpdate['foto_utama'] = $upload['secure_url'];
            } else {
                // 2. JIKA DI LOKAL (Menggunakan Storage Local)
                // Hapus foto lama di storage lokal jika ada
                if ($profile && $profile->foto_utama && Storage::disk('public')->exists($profile->foto_utama)) {
                    Storage::disk('public')->delete($profile->foto_utama);
                }
                
                // Simpan berkas baru ke direktori storage/app/public/profile_desa
                $path = $request->file('foto_utama')->store('profile_desa', 'public');
                $dataUpdate['foto_utama'] = $path;
            }
        }

        // Eksekusi pembaruan data ke database
        DB::table('profile_desa')->where('id', $profile->id)->update($dataUpdate);

        // TAMBAHAN LOG: Update Profil Desa
        DB::table('activity_logs')->insert([
            'user_id'     => Auth::id(),
            'description' => '<strong>' . Auth::user()->name . '</strong> memperbarui komponen data <span class="font-medium text-blue-800">Profil & Statistik Wilayah Desa</span>.',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        return redirect()->back()->with('success', 'Seluruh komponen data profil desa berhasil diperbarui!');
    }
}