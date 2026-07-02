<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TambahKaurSeeder extends Seeder
{
    public function run(): void
    {
        $dataBaru = [
            [
                'jabatan'      => 'Kaur Keuangan',
                'nama'         => 'Belum Diatur',
                'status_aktif' => 'Aktif',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'jabatan'      => 'Kaur Umum',
                'nama'         => 'Belum Diatur',
                'status_aktif' => 'Aktif',
                'created_at'   => now(),
                'updated_at'   => now(),
            ]
        ];

        DB::table('aparatur_desa')->insert($dataBaru);
        $this->command->info("Kaur Keuangan dan Kaur Umum berhasil ditambahkan!");
    }
}