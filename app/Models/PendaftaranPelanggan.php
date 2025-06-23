<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranPelanggan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'pekerjaan',
        'kecamatan_id',
        'kelurahan_id',
        'latitude',
        'longitude',
        'foto_rumah',
        'foto_ktp'
    ];

    /**
     * Get the user that owns the PendaftaranPelanggan.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the kecamatan associated with the PendaftaranPelanggan.
     */
    public function kecamatan()
    {
        // Relasi ke model Kecamatan menggunakan foreign key 'kecamatan_id'
        return $this->belongsTo(Kecamatan::class);
    }

    /**
     * Get the kelurahan associated with the PendaftaranPelanggan.
     */
    public function kelurahan()
    {
        // Relasi ke model Kelurahan menggunakan foreign key 'kelurahan_id'
        return $this->belongsTo(Kelurahan::class);
    }

    /**
     * Get the payments for the PendaftaranPelanggan.
     */
    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'pendaftaran_pelanggan_id');
    }
}

