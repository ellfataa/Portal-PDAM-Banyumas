<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\PendaftaranPelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class PembayaranController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    /**
     * Menampilkan halaman status pembayaran (Semua Tagihan Aktif)
     */
    public function cek(Request $request)
    {
        $user = Auth::user();
        $message = null;
        $messageType = null;

        // Tangani pesan flash session (Error, Success, Info dari aksi sebelumnya)
        if ($request->session()->has('error')) {
            $rawErrorMessage = $request->session()->get('error');
            if (Str::contains($rawErrorMessage, 'ORDER ID HAS ALREADY BEEN TAKEN') || Str::contains($rawErrorMessage, 'order_id has already been taken')) {
                $message = 'ID transaksi sebelumnya sudah digunakan. Sistem telah mencoba membuat yang baru untuk Anda.';
                $messageType = 'info';
            } else {
                $message = 'Terjadi kesalahan: ' . $rawErrorMessage;
                $messageType = 'error';
            }
        } elseif ($request->session()->has('success')) {
            $message = $request->session()->get('success');
            $messageType = 'success';
        } elseif ($request->session()->has('info')) {
            $message = $request->session()->get('info');
            $messageType = 'info';
        } elseif ($request->query('order_id')) {
            $message = 'Menampilkan pembaruan status untuk Order ID: ' . $request->query('order_id');
            $messageType = 'info';
        }

        // Ambil SEMUA pembayaran yang statusnya masih 'pending' (Aktif)
        // (Termasuk yang belum dibayar, atau sudah dibayar tapi menunggu admin)
        $pendingPayments = Pembayaran::where('user_id', $user->id)
                        ->where('status', 'pending')
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('user.pembayaran.cek', compact('pendingPayments', 'message', 'messageType'));
    }

    /**
     * Menampilkan halaman riwayat pembayaran pengguna.
     */
    public function riwayat()
    {
        $riwayats = Pembayaran::where('user_id', Auth::id())->orderByDesc('created_at')->get();
        return view('user.pembayaran.riwayat', compact('riwayats'));
    }

    /**
     * Menampilkan halaman admin untuk melihat semua pembayaran.
     */
    public function index()
    {
        $pembayarans = Pembayaran::with('user')->latest()->get();
        return view('admin.pembayaran.index', compact('pembayarans'));
    }

    /**
     * Mengubah status pembayaran menjadi 'diterima' oleh admin.
     */
    public function terima($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update(['status' => 'diterima']);
        return back()->with('success', 'Pembayaran berhasil diterima.');
    }

    /**
     * Mengubah status pembayaran menjadi 'ditolak' oleh admin.
     */
    public function tolak($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update(['status' => 'ditolak']);
        return back()->with('success', 'Pembayaran berhasil ditolak.');
    }

    /**
     * Menginisiasi pembayaran Midtrans dan menghasilkan Snap Token.
     */
    public function bayarMidtrans(Request $request)
    {
        $user = Auth::user();
        $pendaftaran = PendaftaranPelanggan::where('user_id', $user->id)->latest()->first();

        if (!$pendaftaran) {
            return redirect()->route('user.home')->with('error', 'Silakan daftar terlebih dahulu sebagai pelanggan PDAM.');
        }

        $existingPayment = null;
        $nominalDefault = 150000;

        if ($request->has('order_id')) {
            $existingPayment = Pembayaran::where('user_id', $user->id)
                ->where('order_id', $request->query('order_id'))
                ->where('metode_pembayaran', 'midtrans')
                ->first();

            if ($existingPayment) {
                if ($existingPayment->status === 'diterima' || $existingPayment->status === 'ditolak' ||
                    in_array($existingPayment->midtrans_transaction_status_raw, ['settlement', 'capture'])) {
                    return redirect()->route('pembayaran.cek')->with('error', 'Pembayaran ini sudah diselesaikan.');
                }
            }
        } else {
            $existingPayment = Pembayaran::where('user_id', $user->id)
                ->where('pendaftaran_pelanggan_id', $pendaftaran->id)
                ->where('metode_pembayaran', 'midtrans')
                ->where('status', 'pending')
                ->where(function($query) {
                    $query->whereIn('midtrans_transaction_status_raw', ['pending', 'challenge'])
                          ->orWhereNull('midtrans_transaction_status_raw');
                })
                ->latest()->first();
        }

        if (!$existingPayment) {
            $orderId = 'PDAM-' . strtoupper(Str::random(10));
            $existingPayment = Pembayaran::create([
                'user_id' => $user->id,
                'pendaftaran_pelanggan_id' => $pendaftaran->id,
                'token' => null,
                'order_id' => $orderId,
                'metode_pembayaran' => 'midtrans',
                'nominal' => $nominalDefault,
                'status' => 'pending',
                'gross_amount' => $nominalDefault,
                'payment_type' => null,
                'midtrans_transaction_status_raw' => 'pending',
            ]);
        }

        $appUrl = config('app.url');

        $params = [
            'transaction_details' => [
                'order_id' => $existingPayment->order_id,
                'gross_amount' => $existingPayment->nominal,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
            'callbacks' => [
                'finish' => $appUrl . '/pembayaran/cek',
                'unfinish' => $appUrl . '/pembayaran/cek',
                'error' => $appUrl . '/pembayaran/cek',
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            $existingPayment->update(['token' => $snapToken]);
            return view('user.pembayaran.snap', compact('snapToken'));
        } catch (\Exception $e) {
            Log::error('Gagal membuat Snap Token Midtrans: ' . $e->getMessage());

            if (Str::contains($e->getMessage(), 'order_id has already been taken')) {
                $newOrderId = 'PDAM-' . strtoupper(Str::random(10));
                if ($existingPayment) {
                    $existingPayment->update(['order_id' => $newOrderId]);
                    return redirect()->route('pembayaran.snap', ['order_id' => $newOrderId])->with('info', 'ID transaksi sebelumnya digunakan. Sistem membuat yang baru.');
                }
            }

            return redirect()->route('pembayaran.cek')->with('error', 'Gagal memuat pembayaran. Coba lagi nanti.');
        }
    }

    /**
     * Menangani callback webhook dari Midtrans.
     */
    public function midtransCallback(Request $request)
    {
        $rawInput = file_get_contents('php://input');
        $contentType = $request->header('Content-Type');

        if ($request->isMethod('post') && Str::contains($contentType, 'application/json')) {
            try {
                $notif = new Notification();
            } catch (\Exception $e) {
                return response()->json(['message' => 'Notifikasi tidak valid'], 400);
            }
        } else if ($request->isMethod('post') && Str::contains($contentType, 'application/x-www-form-urlencoded')) {
            return response()->json(['message' => 'Request redirect diterima.'], 200);
        } else {
            return response()->json(['message' => 'Notifikasi tidak valid.'], 400);
        }

        $orderId = $notif->order_id;
        $transactionStatus = $notif->transaction_status;
        $grossAmount = $notif->gross_amount ?? 0;
        $paymentType = $notif->payment_type ?? '';
        $fraudStatus = $notif->fraud_status ?? '';

        $pembayaran = Pembayaran::where('order_id', $orderId)->first();

        if (!$pembayaran) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        $currentStatusDB = $pembayaran->status;
        $newStatusDB = $currentStatusDB;

        if ($transactionStatus == 'capture' && $fraudStatus == 'accept') {
            $newStatusDB = 'pending';
        } else if ($transactionStatus == 'settlement') {
            $newStatusDB = 'pending';
        } else if ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
            $newStatusDB = 'ditolak';
        } else if ($transactionStatus == 'pending' || $transactionStatus == 'challenge' || $transactionStatus == 'authorize') {
            $newStatusDB = 'pending';
        }

        if ($currentStatusDB === 'diterima' || $currentStatusDB === 'ditolak') {
            $newStatusDB = $currentStatusDB;
        }

        $updateData = [
            'status' => $newStatusDB,
            'nominal' => $grossAmount,
            'gross_amount' => $grossAmount,
            'payment_type' => $paymentType,
            'midtrans_transaction_status_raw' => $transactionStatus,
        ];

        if ($newStatusDB !== $currentStatusDB ||
            $pembayaran->nominal != $grossAmount ||
            $pembayaran->payment_type != $paymentType ||
            $pembayaran->midtrans_transaction_status_raw != $transactionStatus) {
            $pembayaran->update($updateData);
        }

        return response()->json(['message' => 'Status transaksi diperbarui.'], 200);
    }
}
