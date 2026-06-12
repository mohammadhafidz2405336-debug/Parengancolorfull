<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            MasterWargaSeeder::class,
            MasterJenisSuratSeeder::class,
            // Jika ada seeder lain (seperti seeder jenis surat), bisa ditaruh di sini
        ]);
    }
}