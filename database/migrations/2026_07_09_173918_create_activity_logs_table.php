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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            // user_id dibuat nullable agar jika ada log otomatis dari sistem tetap bisa tercatat
            $table->unsignedBigInteger('user_id')->nullable(); 
            $table->text('description');
            $table->timestamps();

            // Relasikan ke tabel users jika data user dihapus, lognya ikut terhapus (opsional)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};