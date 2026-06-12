<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    protected $fillable = ['nama_role', 'deskripsi'];

    // Relasi: Satu Role bisa dimiliki oleh banyak User (Admin, Warga, dll)
    public function users(): HasMany
    {
        return $table->hasMany(User::class);
    }
}