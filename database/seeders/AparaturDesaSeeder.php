<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AparaturDesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar jabatan struktural Desa Parengan
        $jabatanAparatur = [
            'Kepala Desa',
            'Sekretaris Desa',
            'Kasi Pemerintahan',
            'Kasi Kesejahteraan',
            'Kasi Pelayanan',
            'Kepala Dusun'
        ];

        foreach ($jabatanAparatur as $jabatan) {
            // Memastikan data tidak duplikat jika seeder dijalankan ulang
            $exists = DB::table('aparatur_desa')->where('jabatan', $jabatan)->exists();
            
            if (!$exists) {
                DB::table('aparatur_desa')->insert([
                    'jabatan'      => $jabatan,
                    'nama'         => 'Belum Diatur', // Teks penanda awal agar halaman profil tidak kosong
                    'foto'         => null,           // Belum ada foto, nanti di-upload admin
                    'status_aktif' => 'Aktif',
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);
            }
        }
    }
}