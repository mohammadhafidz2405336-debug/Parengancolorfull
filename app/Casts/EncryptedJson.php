<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class EncryptedJson implements CastsAttributes
{
    /**
     * Mengubah data dari database (terenkripsi) menjadi array asli saat dibaca di PHP.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if (empty($value)) {
            return [];
        }

        try {
            // 1. Dekripsi string acak dari database menjadi string JSON asli
            $decrypted = Crypt::decryptString($value);

            // 2. Decode string JSON tersebut menjadi array PHP
            return json_decode($decrypted, true) ?? [];
        } catch (\Exception $e) {
            // PENTING: Jika ada data lama yang belum terenkripsi (JSON biasa),
            // tangkap error-nya dan return decode JSON biasa agar aplikasi tidak crash.
            return json_decode($value, true) ?? [];
        }
    }

    /**
     * Mengubah array dari PHP menjadi string terenkripsi saat disimpan ke database.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if (empty($value)) {
            return null;
        }

        // 1. Ubah array PHP menjadi string JSON
        $jsonString = json_encode($value);

        // 2. Enkripsi string JSON tersebut sebelum masuk ke database
        return Crypt::encryptString($jsonString);
    }
}