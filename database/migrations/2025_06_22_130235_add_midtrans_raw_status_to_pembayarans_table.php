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
        // The earlier migration already creates this column. Keep this historical
        // migration safe for databases where either migration was applied first.
        if (! Schema::hasColumn('pembayarans', 'midtrans_transaction_status_raw')) {
            Schema::table('pembayarans', function (Blueprint $table) {
                $table->string('midtrans_transaction_status_raw')->nullable()->after('gross_amount');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // The column is owned by the earlier migration; dropping it here would
        // break rollback when both migrations have been recorded.
    }
};