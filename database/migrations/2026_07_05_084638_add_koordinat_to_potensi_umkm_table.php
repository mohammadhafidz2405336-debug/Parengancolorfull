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
        Schema::table('potensi_umkm', function (Blueprint $table) {
            // Menambahkan kolom koordinat setelah kolom lokasi (nullable agar data lama aman)
            $table->string('koordinat')->nullable()->after('lokasi');
        });
    }

    public function down(): void
    {
        Schema::table('potensi_umkm', function (Blueprint $table) {
            $table->dropColumn('koordinat');
        });
    }
};
