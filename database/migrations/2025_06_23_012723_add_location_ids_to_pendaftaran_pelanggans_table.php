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
        Schema::table('pendaftaran_pelanggans', function (Blueprint $table) {
            // Jika Anda sebelumnya memiliki kolom string 'kecamatan' dan 'kelurahan',
            // Anda harus menghapusnya terlebih dahulu atau mengubahnya menjadi nullable
            // sebelum menambahkan foreign key dengan nama yang sama.
            // Contoh menghapus kolom lama jika ada:
            // $table->dropColumn(['kecamatan', 'kelurahan']);

            // Tambahkan kolom foreignId untuk kecamatan_id
            $table->foreignId('kecamatan_id')
                  ->nullable() // Izinkan null jika pendaftaran tidak selalu punya kecamatan/kelurahan
                  ->constrained('kecamatans') // Merujuk ke tabel 'kecamatans'
                  ->onDelete('set null'); // Jika kecamatan dihapus, set null di sini

            // Tambahkan kolom foreignId untuk kelurahan_id
            $table->foreignId('kelurahan_id')
                  ->nullable() // Izinkan null
                  ->constrained('kelurahans') // Merujuk ke tabel 'kelurahans'
                  ->onDelete('set null'); // Jika kelurahan dihapus, set null di sini
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftaran_pelanggans', function (Blueprint $table) {
            // Hapus foreign key constraint terlebih dahulu
            $table->dropConstrainedForeignId('kecamatan_id');
            $table->dropConstrainedForeignId('kelurahan_id');

            // Opsional: Jika Anda menghapus kolom string di `up` method,
            // Anda mungkin ingin menambahkannya kembali di `down` method.
            // $table->string('kecamatan')->nullable();
            // $table->string('kelurahan')->nullable();
        });
    }
};

