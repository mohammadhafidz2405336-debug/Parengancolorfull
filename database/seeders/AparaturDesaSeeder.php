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
    }
}