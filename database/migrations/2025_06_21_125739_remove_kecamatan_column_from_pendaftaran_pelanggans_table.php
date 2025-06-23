<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Hapus kolom kecamatan dan kelurahan jika ada.
     */
    public function up(): void
    {
        Schema::table('pendaftaran_pelanggans', function (Blueprint $table) {
            if (Schema::hasColumn('pendaftaran_pelanggans', 'kecamatan')) {
                $table->dropColumn('kecamatan');
            }

            if (Schema::hasColumn('pendaftaran_pelanggans', 'kelurahan')) {
                $table->dropColumn('kelurahan');
            }
        });
    }

    /**
     * Tambahkan kembali kolom jika migrasi di-rollback.
     */
    public function down(): void
    {
        Schema::table('pendaftaran_pelanggans', function (Blueprint $table) {
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();
        });
    }
};
