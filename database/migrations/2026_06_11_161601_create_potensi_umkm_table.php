<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('potensi_umkm', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); 
            $table->enum('jenis', ['unggulan', 'umkm']); // Untuk memisahkan mana potensi utama & mana list UMKM
            $table->string('kategori')->nullable(); // cth: Makanan Ringan, Kerajinan
            $table->text('deskripsi');
            $table->string('foto')->nullable();
            $table->string('pemilik')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('kontak')->nullable(); // Nomor WA
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('potensi_umkm');
    }
};