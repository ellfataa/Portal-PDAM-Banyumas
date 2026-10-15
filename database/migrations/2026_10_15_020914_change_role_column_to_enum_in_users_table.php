<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Tambahkan ini untuk Query Builder

return new class extends Migration
{
    public function up(): void
    {
        DB::table('users')->where('role', 'user')->update(['role' => 'pelanggan']);

        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'pelanggan'])->default('pelanggan')->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user')->change();
        });

        DB::table('users')->where('role', 'pelanggan')->update(['role' => 'user']);
    }
};
