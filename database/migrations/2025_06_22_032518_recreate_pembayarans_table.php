<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop the table if it already exists to ensure a clean slate
        Schema::dropIfExists('pembayarans');

        // Create the new pembayarans table
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('pendaftaran_pelanggan_id')->constrained()->onDelete('cascade');
            // 'token' hanya untuk pembayaran manual, karena kita fokus Midtrans, bisa nullable
            // atau bahkan dihilangkan jika Anda yakin tidak akan pernah pakai manual lagi
            $table->string('token')->nullable(); // Tetap nullable untuk fleksibilitas

            // 'order_id' adalah identitas transaksi utama untuk Midtrans
            $table->string('order_id')->nullable()->unique(); // Pastikan order_id unik

            // Metode pembayaran: 'midtrans'
            $table->string('metode_pembayaran')->default('midtrans'); // Default ke 'midtrans'

            $table->bigInteger('nominal'); // Nominal pembayaran awal saat dibuat
            $table->string('bukti_transfer')->nullable(); // Tidak digunakan untuk Midtrans, tapi tetap ada jika sewaktu-waktu dibutuhkan

            // Status pembayaran
            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');

            // Tipe pembayaran dari Midtrans (misal: bank_transfer, credit_card)
            $table->string('payment_type')->nullable(); // Untuk menyimpan tipe pembayaran dari Midtrans

            // Gross amount dari Midtrans (jumlah aktual yang dibayar, bisa beda dengan nominal awal karena biaya admin dll)
            // Bisa juga diupdate nominal saja, tergantung kebutuhan
            $table->decimal('gross_amount', 10, 2)->nullable(); // Menambahkan kolom ini untuk data dari Midtrans callback

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};