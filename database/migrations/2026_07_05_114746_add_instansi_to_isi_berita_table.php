<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('isi_berita', function (Blueprint $table) {
            $table->string('instansi')->nullable(); // Contoh: KKN UM
            $table->renameColumn('penulis', 'pewarta'); // Mengubah nama kolom penulis jadi pewarta
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('isi_berita', function (Blueprint $table) {
            //
        });
    }
};
