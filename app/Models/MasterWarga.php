<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterWarga extends Model
{
    use HasFactory;

    // TAMBAHKAN BARIS INI untuk mengunci nama tabel database:
    protected $table = 'master_warga';

    protected $fillable = [
        'nik_hash',
        'nik',
        'nama',
        'rt',
        'rw'
    ];

    // Otomatis enkripsi kolom NIK saat masuk ke database
    // protected $casts = [
    //     'nik' => 'encrypted',
    // ];
}