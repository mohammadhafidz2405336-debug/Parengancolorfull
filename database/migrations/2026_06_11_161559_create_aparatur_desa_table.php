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
        Schema::create('aparatur_desa', function (Blueprint $table) {
            $table->id();
            $table->string('jabatan');
            $table->string('nama')->nullable(); 
            $table->string('foto')->nullable(); 
            
            $table->string('email')->nullable(); 
            $table->string('jam_pelayanan')->nullable();
            $table->text('tupoksi')->nullable(); 
            
            $table->string('status_aktif')->default('Aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aparatur_desa');
    }
};