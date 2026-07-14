<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\EncryptedJson;

class PermohonanSurat extends Model
{
    use HasFactory;

    protected $table = 'permohonan_surat';

    protected $fillable = [
        'admin_id',
        'jenis_surat_id',
        'nik_hash',
        'data_input',
        'status',
        'keterangan_admin',
    ];

    protected $casts = [
        'data_input' => EncryptedJson::class,
    ];

    /**
     * Relasi ke Master Jenis Surat
     */
    public function jenisSurat()
    {
        return $this->belongsTo(MasterJenisSurat::class, 'jenis_surat_id');
    }
}