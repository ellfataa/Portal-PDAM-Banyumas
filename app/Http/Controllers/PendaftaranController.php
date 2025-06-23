<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranPelanggan;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PendaftaranController extends Controller
{
    /**
     * Form pendaftaran pelanggan.
     */
    public function create()
    {
        $kecamatans = Kecamatan::orderBy('nama')->get(); //
        return view('user.pendaftaran.create', compact('kecamatans')); //
    }

    /**
     * Simpan data pendaftaran pelanggan dan buat tagihan pembayaran baru.
     */
    public function store(Request $request)
    {
        $request->validate([ //
            'nama_lengkap'   => 'required|string|max:255', //
            'pekerjaan'      => 'required|string|max:255', //
            'kecamatan_id'   => 'required|exists:kecamatans,id', //
            'kelurahan_id'   => 'required|exists:kelurahans,id', //
            'latitude'       => 'required|numeric', //
            'longitude'      => 'required|numeric', //
            'foto_rumah'     => 'required|image|mimes:jpg,jpeg,png|max:2048', //
            'foto_ktp'       => 'required|image|mimes:jpg,jpeg,png|max:2048', //
        ]); //

        $user = Auth::user(); //

        // Simpan file gambar
        $fotoRumahPath = $request->file('foto_rumah')->store('uploads/rumah', 'public'); //
        $fotoKtpPath   = $request->file('foto_ktp')->store('uploads/ktp', 'public'); //

        // Simpan data pendaftaran pelanggan baru
        $pendaftaran = PendaftaranPelanggan::create([ //
            'user_id'        => $user->id, //
            'nama_lengkap'   => $request->nama_lengkap, //
            'pekerjaan'      => $request->pekerjaan, //
            'kecamatan_id'   => $request->kecamatan_id, //
            'kelurahan_id'   => $request->kelurahan_id, //
            'latitude'       => $request->latitude, //
            'longitude'      => $request->longitude, //
            'foto_rumah'     => $fotoRumahPath, //
            'foto_ktp'       => $fotoKtpPath, //
        ]); //

        // Konfigurasi default pembayaran untuk Midtrans
        $nominal = 150000; //
        $metode = 'midtrans'; //
        $orderId = 'PDAM-' . strtoupper(Str::random(10)); //

        // Simpan data pembayaran baru
        Pembayaran::create([ //
            'user_id' => $user->id, //
            'pendaftaran_pelanggan_id' => $pendaftaran->id, //
            'token' => null, // Token tidak diperlukan untuk Midtrans
            'order_id' => $orderId, //
            'metode_pembayaran' => $metode, //
            'nominal' => $nominal, //
            'status' => 'pending', //
        ]); //

        // Redirect ke halaman pembayaran Midtrans
        return redirect()->route('pembayaran.snap')->with('success', 'Pendaftaran berhasil. Silakan selesaikan pembayaran.'); //
    }
}