<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil seeder KecamatanKelurahanSeeder untuk mengisi data kecamatan dan kelurahan
        $this->call(KecamatanKelurahanSeeder::class);

        // Contoh pembuatan user bawaan (bisa dipertahankan atau dihapus sesuai kebutuhan)
        // User::factory(10)->create(); // Jika Anda ingin membuat 10 user acak

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            // Anda mungkin ingin menambahkan password di sini jika tidak menggunakan hashed password default
            // 'password' => bcrypt('password'), // Contoh password
        ]);
    }
}