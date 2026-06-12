<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterWarga; 

class MasterWargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 0; $i < 10; $i++) {
            // Generate 16 digit angka NIK acak terlebih dahulu
            $nikAcak = $faker->numerify('3524############'); 

            MasterWarga::create([
                'nik_hash' => hash('sha256', $nikAcak), // Buat hash-nya untuk pencarian cepat
                'nik'      => $nikAcak,                 // NIK asli (akan otomatis terenkripsi berkat casting di model)
                'nama'     => $faker->name,
                'rt'       => sprintf("%03d", $faker->numberBetween(1, 10)),
                'rw'       => sprintf("%03d", $faker->numberBetween(1, 5)),
            ]);
        }
    }
}