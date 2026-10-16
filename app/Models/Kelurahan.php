<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kecamatan_id',
        'nama',
    ];

    /**
     * Relasi belongs-to ke model Kecamatan
     */
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    /**
     * Relasi one-to-many ke model PendaftaranPelanggan
     */
    public function pendaftaranPelanggans()
    {
        return $this->hasMany(PendaftaranPelanggan::class);
    }
}
