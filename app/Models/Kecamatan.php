<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
    ];

    /**
     * Relasi one-to-many ke model Kelurahan
     */
    public function kelurahans()
    {
        return $this->hasMany('App\\Models\\Kelurahan');
    }

    /**
     * Relasi one-to-many ke model PendaftaranPelanggan
     */
    public function pendaftaranPelanggans()
    {
        return $this->hasMany(PendaftaranPelanggan::class);
    }
}
