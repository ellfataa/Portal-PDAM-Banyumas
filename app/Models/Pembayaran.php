<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pendaftaran_pelanggan_id',
        'token',
        'order_id',
        'metode_pembayaran',
        'nominal',
        'bukti_transfer',
        'status',
        'payment_type',
        'gross_amount',
        'midtrans_transaction_status_raw',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pendaftaran()
    {
        return $this->belongsTo(PendaftaranPelanggan::class, 'pendaftaran_pelanggan_id');
    }
}