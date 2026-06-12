<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MasterJenisSurat extends Model
{
    // Wajib didefinisikan karena nama tabel kustom
    protected $table = 'master_jenis_surat'; 

    protected $fillable = ['nama_surat'];

    // Relasi: Satu jenis surat bisa punya banyak permohonan
    public function permohonanSurat(): HasMany
    {
        return $this->hasMany(PermohonanSurat::class, 'jenis_surat_id');
    }
}