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

        foreach ($jabatanAparatur as $jabatan) {
            // Cukup insert langsung tanpa pengecekan
            DB::table('aparatur_desa')->insert([
                'jabatan'      => $jabatan,
                'nama'         => 'Belum Diatur',
                'status_aktif' => 'Aktif',
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
            
            // Debugging: Cetak ke console agar kita tahu perulangan berjalan
            $this->command->info("Inserting: " . $jabatan);
        }
    }
}