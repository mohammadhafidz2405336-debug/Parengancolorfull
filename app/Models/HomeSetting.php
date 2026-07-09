<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSetting extends Model
{
    use HasFactory;

    protected $table = 'home_settings';

    protected $fillable = [
        'hero_images',
        'kades_nama',
        'kades_masa_jabatan',
        'kades_foto',
        'sambutan',
        'program_1_judul',
        'program_1_deskripsi',
        'program_2_judul',
        'program_2_deskripsi',
        'program_3_judul',
        'program_3_deskripsi',
        'kontak_telepon',
        'kontak_email',
        'kontak_instagram',
    ];

    // === PASTIKAN BARIS INI ADA ===
    protected $casts = [
        'hero_images' => 'array',
    ];
}