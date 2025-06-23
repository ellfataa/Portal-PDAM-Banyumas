<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pendaftaran_pelanggans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_lengkap');
            $table->string('pekerjaan');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->decimal('latitude', 10, 6);
            $table->decimal('longitude', 10, 6);
            $table->string('foto_rumah'); // path
            $table->string('foto_ktp');   // path
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('pendaftaran_pelanggans');
    }
};
