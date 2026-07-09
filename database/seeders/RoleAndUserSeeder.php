<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role; 
use App\Models\User; 
use Illuminate\Support\Facades\Hash; 

class RoleAndUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat Data Roles terlebih dahulu
        $roleAdmin = Role::create([
            'nama_role' => 'admin_utama',
            'deskripsi' => 'Administrator dengan hak akses penuh'
        ]);

        $rolePerangkat = Role::create([
            'nama_role' => 'perangkat_desa',
            'deskripsi' => 'Perangkat desa untuk manajemen data'
        ]);

        $roleKarangTaruna = Role::create([
            'nama_role' => 'karang_taruna',
            'deskripsi' => 'Pengelola konten Karang Taruna'
        ]);

        // 2. Buat Akun Admin Utama dengan data dari .env
        // Menggunakan env('NAMA_VARIABEL', 'nilai_default_jika_kosong')
        User::create([
            'name'      => env('ADMIN_NAME', 'Admin Default'),
            'email'     => env('ADMIN_EMAIL', 'admin@default.com'), // Perbaikan tanda kutip di sini
            'password'  => Hash::make(env('ADMIN_PASSWORD', 'password_default')), 
            'role_id'   => $roleAdmin->id,
        ]);
    }
}