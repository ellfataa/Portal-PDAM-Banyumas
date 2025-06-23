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
        Schema::table('pembayarans', function (Blueprint $table) {
            // Tambahkan kolom baru. String/varchar cukup untuk menyimpan status seperti 'settlement', 'pending', 'expire'
            $table->string('midtrans_transaction_status_raw')->nullable()->after('gross_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembayarans', function (Blueprint $table) {
            $table->dropColumn('midtrans_transaction_status_raw');
        });
    }
};