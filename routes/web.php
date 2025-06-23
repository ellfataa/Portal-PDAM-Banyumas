<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\AdminController;
use App\Models\Kelurahan;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    return $user->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('user.home');
})->middleware(['auth', 'verified'])->name('dashboard');

// =====================
// Webhook Midtrans Callback (HARUS DI LUAR GROUP MIDDLEWARE 'auth')
// =====================
Route::post('/callback/midtrans', [PembayaranController::class, 'midtransCallback'])->name('midtrans.callback');

// Routes untuk user yang sudah login
Route::middleware('auth')->group(function () {

    // =====================
    // PROFILE
    // =====================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // =====================
    // ADMIN
    // =====================
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // Rute untuk Kelola Pelanggan
        Route::get('/admin/pelanggan', [AdminController::class, 'kelolaPelanggan'])->name('admin.pelanggan.index');
        Route::get('/admin/pelanggan/{id}/edit', [AdminController::class, 'editPelanggan'])->name('admin.pelanggan.edit');
        Route::patch('/admin/pelanggan/{id}', [AdminController::class, 'updatePelanggan'])->name('admin.pelanggan.update');
        Route::delete('/admin/pelanggan/{id}', [AdminController::class, 'destroyPelanggan'])->name('admin.pelanggan.destroy');

        // Rute untuk Laporan Keuangan
        Route::get('/admin/laporan-keuangan', [AdminController::class, 'laporanKeuangan'])->name('admin.laporan.keuangan');


        Route::get('/admin/pembayaran', [PembayaranController::class, 'index'])->name('admin.pembayaran.index');
        Route::post('/admin/pembayaran/{id}/terima', [PembayaranController::class, 'terima'])->name('admin.pembayaran.terima');
        Route::post('/admin/pembayaran/{id}/tolak', [PembayaranController::class, 'tolak'])->name('admin.pembayaran.tolak');
    });

    // =====================
    // USER (Pelanggan)
    // =====================
    Route::middleware('role:user')->group(function () {
        Route::get('/user/home', fn() => view('user.home'))->name('user.home');

        // Pendaftaran Pelanggan
        Route::get('/pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran.form');
        Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

        // Pembayaran
        Route::get('/pembayaran/cek', [PembayaranController::class, 'cek'])->name('pembayaran.cek');
        Route::get('/pembayaran/riwayat', [PembayaranController::class, 'riwayat'])->name('pembayaran.riwayat');

        // Snap Midtrans
        Route::get('/pembayaran/snap', [PembayaranController::class, 'bayarMidtrans'])->name('pembayaran.snap');

        // API Kelurahan by Kecamatan ID
        Route::get('/get-kelurahan/{kecamatan_id}', function ($kecamatan_id) {
            return Kelurahan::where('kecamatan_id', $kecamatan_id)->select('id', 'nama')->get();
        });
    });
});

// Auth Routes dari Laravel Breeze
require __DIR__ . '/auth.php';

