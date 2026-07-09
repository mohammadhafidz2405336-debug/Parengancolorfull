<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_settings', function (Blueprint $table) {
            $table->id();
            // Slider Banner (JSON untuk menampung array path gambar)
            $table->json('hero_images')->nullable(); 
            
            // Sambutan & Profil Kades
            $table->string('kades_nama')->nullable();
            $table->string('kades_masa_jabatan')->nullable();
            $table->string('kades_foto')->nullable();
            $table->text('sambutan')->nullable();
            
            // Program Kerja / Visi Misi (3 Card)
            $table->string('program_1_judul')->nullable();
            $table->text('program_1_deskripsi')->nullable();
            $table->string('program_2_judul')->nullable();
            $table->text('program_2_deskripsi')->nullable();
            $table->string('program_3_judul')->nullable();
            $table->text('program_3_deskripsi')->nullable();
            
            // Kontak Beranda
            $table->string('kontak_telepon')->nullable();
            $table->string('kontak_email')->nullable();
            $table->string('kontak_instagram')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_settings');
    }
};