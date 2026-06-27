<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    // Tentukan nama tabel jika nama tabelmu di database bukan "beritas" (misal: "berita")
    protected $table = 'isi_berita'; 

    // Daftarkan kolom yang bisa diisi sesuai dengan struktur tabel beritamu
    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'penulis',
        'gambar',
        'isi_berita',
        'user_id'
    ];
}