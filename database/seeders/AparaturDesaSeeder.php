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
        $jabatanAparatur = [
            'Kepala Desa',
            'Sekretaris Desa',
            'Kasi Pemerintahan',
            'Kasi Kesejahteraan',
            'Kasi Pelayanan',
            'Kepala Dusun'
        ];

        // Tambahkan bagian ini agar data benar-benar masuk ke database:
        foreach ($jabatanAparatur as $jabatan) {
            DB::table('aparatur_desa')->insert([
                'jabatan'      => $jabatan,
                'nama'         => 'Belum Diatur',
                'status_aktif' => 'Aktif',
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}