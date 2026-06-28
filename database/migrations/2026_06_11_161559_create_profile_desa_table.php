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
        Schema::create('profile_desa', function (Blueprint $table) {
            $table->id();
            // Profil Umum Desa
            $table->string('nama_desa')->default('Desa Parengan');
            $table->text('deskripsi_umum')->nullable();
            $table->string('foto_utama')->nullable();
            
            // Visi & Misi
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();

            // Data Kependudukan Utama
            $table->integer('jumlah_laki')->default(0);
            $table->integer('jumlah_perempuan')->default(0);
            $table->integer('total_kk')->default(0);

            // Statistik Agama
            $table->integer('agama_islam')->default(0);
            $table->integer('agama_kristen')->default(0);
            $table->integer('agama_katolik')->default(0);
            $table->integer('agama_lainnya')->default(0);

            // Statistik Pendidikan
            $table->integer('pndk_belum_sekolah')->default(0);
            $table->integer('pndk_sd')->default(0);
            $table->integer('pndk_smp')->default(0);
            $table->integer('pndk_sma')->default(0);
            $table->integer('pndk_sarjana')->default(0);

            // Statistik Rentang Umur
            $table->integer('umur_anak')->default(0);
            $table->integer('umur_produktif')->default(0);
            $table->integer('umur_lansia')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_desa');
    }
};