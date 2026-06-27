<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterJenisSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menggunakan insertOrIgnore agar data yang sudah ada diabaikan dan tidak memicu error duplicate key
        DB::table('master_jenis_surat')->insertOrIgnore([
            [
                'id' => 1,
                'nama_surat' => 'Pembuatan Akta Nikah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nama_surat' => 'Pembuatan Kartu Keluarga (KK)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nama_surat' => 'Pembaharui Kartu Keluarga (KK)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'nama_surat' => 'Pembuatan Akta Lahir',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'nama_surat' => 'Pembuatan KIA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'nama_surat' => 'Pembuatan KTP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'nama_surat' => 'Pembuatan Surat Domisili',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'nama_surat' => 'Pembuatan SKTM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'nama_surat' => 'Pembuatan SKTM', // Sesuaikan jika ada perbedaan nama surat ke-9
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}