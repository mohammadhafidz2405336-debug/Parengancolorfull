<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('isi_berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul');        // Diubah jadi huruf kecil semua
            $table->string('slug')->nullable(); // Ditambahkan nullable jika belum membuat generator otomatisnya
            $table->string('kategori');     // Diubah jadi huruf kecil semua
            $table->string('penulis');      // Ditambahkan kolom penulis sesuai form dan controller kamu
            $table->text('isi_berita');     // Diubah dari 'konten' menjadi 'isi_berita' agar sinkron dengan model/form
            $table->string('gambar')->nullable();
            
            // Opsional: Tetap pertahankan user_id jika nanti ingin melacak admin mana yang login
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('isi_berita');
    }
};