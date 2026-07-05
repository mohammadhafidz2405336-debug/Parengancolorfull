<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PotensiUmkm extends Model
{
    use HasFactory;

    protected $table = 'potensi_umkm';
    
    // Menggunakan fillable jauh lebih aman dan direkomendasikan agar Laravel mengenali setiap kolom dari form
    protected $fillable = [
        'nama',
        'jenis',
        'kategori',
        'pemilik',
        'lokasi',
        'koordinat',
        'kontak',
        'deskripsi',
        'foto'
    ];
}