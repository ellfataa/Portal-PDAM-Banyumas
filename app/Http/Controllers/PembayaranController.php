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
        // Konfigurasi Midtrans dari file config/midtrans.php atau .env
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    /**
     * Menampilkan halaman status pembayaran untuk transaksi spesifik
     * atau mengarahkan ke transaksi terbaru jika tidak ada order_id di URL.
     */
    public function cek(Request $request)
    {
        $user = Auth::user();
        $message = null;
        $messageType = null;
        $payment = null;

        $midtransRedirectOrderId = $request->query('order_id');
        $midtransRedirectStatus = $request->query('transaction_status'); // Status transaksi dari Midtrans redirect (dari URL)

        // Jika tidak ada order_id di URL, cari pembayaran terakhir yang relevan dan redirect
        if (empty($midtransRedirectOrderId)) {
            $latestRelevantPayment = $user->pembayarans()
                                          ->where('metode_pembayaran', 'midtrans')
                                          // Prioritas pencarian:
                                          // 1. Belum Bayar (status DB pending, Midtrans raw pending/challenge/null)
                                          // 2. Pending (status DB pending, Midtrans raw settlement/capture)
                                          // 3. Terbaru secara umum
                                          ->orderByRaw("
                                              CASE
                                                  WHEN status = 'pending' AND (midtrans_transaction_status_raw = 'pending' OR midtrans_transaction_status_raw = 'challenge' OR midtrans_transaction_status_raw IS NULL) THEN 0
                                                  WHEN status = 'pending' AND (midtrans_transaction_status_raw = 'settlement' OR midtrans_transaction_status_raw = 'capture') THEN 1
                                                  ELSE 2
                                              END ASC, created_at DESC
                                          ")
                                          ->first();

            if ($latestRelevantPayment) {
                $redirectParams = [
                    'order_id' => $latestRelevantPayment->order_id,
                    // Kirimkan midtrans_transaction_status_raw sebagai transaction_status di URL
                    'transaction_status' => $latestRelevantPayment->midtrans_transaction_status_raw ?? $latestRelevantPayment->status,
                ];
                return redirect()->route('pembayaran.cek', $redirectParams);
            } else {
                // Jika tidak ada pembayaran Midtrans yang ditemukan
                $message = 'Tidak ada transaksi pembayaran Midtrans yang sedang diproses atau belum diselesaikan untuk akun Anda.';
                $messageType = 'info';
            }
        }

        // === Logika Menampilkan Pembayaran (setelah order_id dipastikan ada) ===
        $payment = $user->pembayarans()->where('order_id', $midtransRedirectOrderId)->first();

        $displayStatus = null;
        $actionButton = null;

        if ($payment) {
            // Dapatkan status Midtrans raw yang paling efektif (dari URL atau DB)
            $effectiveMidtransStatus = $midtransRedirectStatus ?? $payment->midtrans_transaction_status_raw;

            // Logika penentuan displayStatus dan actionButton berdasarkan kriteria Anda
            if ($payment->status === 'diterima') {
                $displayStatus = 'Diterima';
                $message = 'Pembayaran Anda dengan Order ID **' . $midtransRedirectOrderId . '** telah berhasil dan diverifikasi. Silakan cek detail di bawah.';
                $messageType = 'success';
                $actionButton = 'Lihat Pembayaran';
            } elseif ($payment->status === 'ditolak') {
                $displayStatus = 'Ditolak';
                $message = 'Pembayaran Anda dengan Order ID **' . $midtransRedirectOrderId . '** gagal atau dibatalkan.';
                $messageType = 'error';
                $actionButton = 'Lihat Pembayaran';
            } elseif ($payment->status === 'pending') { // Jika status DB masih pending
                if ($effectiveMidtransStatus === 'settlement' || $effectiveMidtransStatus === 'capture') {
                    // Berhasil di Midtrans, tapi menunggu verifikasi admin
                    $displayStatus = 'Pending'; // Status di UI untuk "Menunggu Konfirmasi Admin"
                    $message = 'Pembayaran Anda dengan Order ID **' . $midtransRedirectOrderId . '** berhasil! Status saat ini **Pending (Menunggu Konfirmasi Admin)**. Silakan cek detail di bawah.';
                    $messageType = 'success';
                    $actionButton = 'Lihat Pembayaran';
                } elseif (in_array($effectiveMidtransStatus, ['pending', 'challenge']) || $effectiveMidtransStatus === null) {
                    // Belum selesai di Midtrans (pending/challenge) atau belum ada status raw Midtrans
                    $displayStatus = 'Belum Bayar'; // Status di UI untuk "Belum Bayar"
                    $message = 'Pembayaran Anda dengan Order ID **' . $midtransRedirectOrderId . '** tertunda. Silakan selesaikan pembayaran.';
                    $messageType = 'info';
                    $actionButton = 'Lanjutkan Pembayaran';
                } else {
                    // Fallback jika ada status pending di DB tapi Midtrans raw tidak cocok
                    $displayStatus = 'Belum Bayar'; // Default ke Belum Bayar jika bingung
                    $message = 'Status pembayaran Anda dengan Order ID **' . $midtransRedirectOrderId . '** tidak dapat ditentukan secara spesifik. Silakan hubungi admin.';
                    $messageType = 'warning';
                    $actionButton = 'Lihat Pembayaran';
                }
            } else {
                // Fallback untuk status lain yang tidak terduga atau tidak ditangani secara spesifik
                $displayStatus = ucfirst($payment->status);
                $message = 'Status pembayaran Anda dengan Order ID **' . $midtransRedirectOrderId . '** adalah **' . $displayStatus . '**. Silakan cek detail di bawah.';
                $messageType = 'warning';
                $actionButton = 'Lihat Pembayaran';
            }
        } else {
            // Pembayaran tidak ditemukan (baik dari URL atau dari dispatcher)
            $message = 'Pembayaran dengan Order ID **' . $midtransRedirectOrderId . '** tidak ditemukan untuk akun Anda.';
            $messageType = 'error';
            $actionButton = 'Lihat Pembayaran';
        }

        // Tangani pesan flash session (prioritas lebih rendah dari pesan spesifik di atas)
        // Ini akan menimpa $message dan $messageType jika ada flash session
        if ($request->session()->has('error')) {
            $rawErrorMessage = $request->session()->get('error');
            if (Str::contains($rawErrorMessage, 'ORDER ID HAS ALREADY BEEN TAKEN') || Str::contains($rawErrorMessage, 'order_id has already been taken')) {
                $message = 'ID transaksi sebelumnya sudah digunakan. Sistem telah mencoba membuat yang baru untuk Anda.';
                $messageType = 'info';
            } else {
                $message = 'Terjadi kesalahan saat memproses pembayaran Anda: ' . $rawErrorMessage . '. Silakan coba lagi nanti.';
                $messageType = 'error';
            }
        } elseif ($request->session()->has('success')) {
            $message = $request->session()->get('success');
            $messageType = 'success';
        } elseif ($request->session()->has('info')) {
            $message = $request->session()->get('info');
            $messageType = 'info';
        }

        return view('user.pembayaran.cek', compact('payment', 'message', 'messageType', 'displayStatus', 'actionButton'));
    }

    /**
     * Menampilkan halaman riwayat pembayaran pengguna.
     */
    public function riwayat()
    {
        $riwayats = Auth::user()->pembayarans()->orderByDesc('created_at')->get();
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
     *
     * @param int $id ID pembayaran
     */
    public function terima($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update([
            'status' => 'diterima',
            // Opsi: Jika Anda ingin mencatat bahwa status raw juga "diselesaikan" oleh admin
            // 'midtrans_transaction_status_raw' => 'settlement'
        ]);
        return back()->with('success', 'Pembayaran berhasil diterima.');
    }

    /**
     * Mengubah status pembayaran menjadi 'ditolak' oleh admin.
     *
     * @param int $id ID pembayaran
     */
    public function tolak($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update([
            'status' => 'ditolak',
            // Opsi: Jika Anda ingin mencatat bahwa status raw juga "ditolak" oleh admin
            // 'midtrans_transaction_status_raw' => 'deny'
        ]);
        return back()->with('success', 'Pembayaran berhasil ditolak.');
    }

    /**
     * Menginisiasi pembayaran Midtrans dan menghasilkan Snap Token.
     */
    public function bayarMidtrans(Request $request)
    {
        $user = Auth::user();
        $pendaftaran = $user->pendaftarans()->latest()->first();

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
                // Jangan izinkan melanjutkan jika sudah diterima, ditolak, atau sudah settlement/capture di Midtrans
                // Logika ini sangat penting untuk memastikan hanya transaksi "Belum Bayar" yang bisa dilanjutkan
                if ($existingPayment->status === 'diterima' || $existingPayment->status === 'ditolak' ||
                    in_array($existingPayment->midtrans_transaction_status_raw, ['settlement', 'capture'])) {
                    return redirect()->route('pembayaran.cek', ['order_id' => $existingPayment->order_id])->with('error', 'Pembayaran ini sudah ' . ucfirst($existingPayment->status) . ' atau sudah diselesaikan.');
                }
                // Jika statusnya pending (baik di DB maupun Midtrans raw 'pending'/'challenge'), maka bisa dilanjutkan
            }
        } else {
            // Jika tidak ada order_id di query string, cari pembayaran pending terbaru
            // yang belum selesai di Midtrans (status DB pending DAN Midtrans raw pending/challenge/null)
            $existingPayment = Pembayaran::where('user_id', $user->id)
                ->where('pendaftaran_pelanggan_id', $pendaftaran->id)
                ->where('metode_pembayaran', 'midtrans')
                ->where('status', 'pending') // Pastikan status DB masih pending
                ->where(function($query) {
                    $query->whereIn('midtrans_transaction_status_raw', ['pending', 'challenge'])
                          ->orWhereNull('midtrans_transaction_status_raw'); // Atau jika belum ada status raw
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
                'status' => 'pending', // Default status di DB saat buat baru (untuk verifikasi admin)
                'gross_amount' => $nominalDefault,
                'payment_type' => null,
                'midtrans_transaction_status_raw' => 'pending', // Inisialisasi status mentah Midtrans sebagai 'pending'
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
            Log::error('Gagal membuat Snap Token Midtrans: ' . $e->getMessage(), [
                'user_id' => $user->id,
                'order_id' => $existingPayment->order_id ?? 'N/A',
                'pendaftaran_id' => $pendaftaran->id ?? 'N/A',
                'exception_class' => get_class($e)
            ]);

            if (Str::contains($e->getMessage(), 'order_id has already been taken')) {
                $newOrderId = 'PDAM-' . strtoupper(Str::random(10));
                if ($existingPayment) {
                    $existingPayment->update(['order_id' => $newOrderId]);
                    return redirect()->route('pembayaran.snap', ['order_id' => $newOrderId])->with('info', 'ID transaksi sebelumnya sudah digunakan. Sistem mencoba membuat yang baru untuk Anda.');
                }
            }

            return redirect()->route('pembayaran.cek')->with('error', 'Gagal memuat pembayaran. Silakan coba lagi nanti atau hubungi admin jika masalah berlanjut.');
        }
    }

    /**
     * Menangani callback webhook dari Midtrans untuk memperbarui status pembayaran.
     * Metode ini dirancang KHUSUS untuk menerima POST request JSON dari SERVER MIDTRANS.
     */
    public function midtransCallback(Request $request)
    {
        $rawInput = file_get_contents('php://input');
        $contentType = $request->header('Content-Type');

        Log::info('Midtrans Webhook: Raw Input Received', ['raw_input' => $rawInput]);
        Log::info('Midtrans Webhook: Request Headers', ['headers' => $request->headers->all()]);
        Log::info('Midtrans Webhook: Content-Type Header', ['content_type' => $contentType]);

        if ($request->isMethod('post') && Str::contains($contentType, 'application/json')) {
            try {
                $notif = new Notification();
                Log::info('Midtrans Webhook: Notification object created successfully from application/json.');
            } catch (\Exception $e) {
                Log::error('Midtrans Webhook: Gagal membuat objek Notifikasi Midtrans dari JSON', [
                    'error' => $e->getMessage(),
                    'raw_input_on_error' => $rawInput,
                    'stack_trace' => $e->getTraceAsString()
                ]);
                return response()->json(['message' => 'Notifikasi tidak valid: ' . $e->getMessage()], 400);
            }
        } else if ($request->isMethod('post') && Str::contains($contentType, 'application/x-www-form-urlencoded')) {
            // Ini adalah POST request dari browser klien (redirect), BUKAN webhook server-to-server.
            Log::warning('Midtrans Webhook: Menerima request POST dari client redirect (application/x-www-form-urlencoded). Ini BUKAN webhook server-to-server Midtrans yang diharapkan untuk pemrosesan status.', [
                'request_data' => $request->all(),
                'raw_input' => $rawInput
            ]);
            return response()->json(['message' => 'Request redirect dari browser berhasil diterima.'], 200);
        } else {
            Log::error('Midtrans Webhook: Request tidak valid (bukan POST atau Content-Type bukan JSON/x-www-form-urlencoded).', [
                'method' => $request->method(),
                'content_type' => $contentType,
                'raw_input' => $rawInput
            ]);
            return response()->json(['message' => 'Notifikasi tidak valid: Metode atau Content-Type tidak didukung.'], 400);
        }

        $orderId = $notif->order_id;
        $transactionStatus = $notif->transaction_status; // settlement, pending, deny, expire, cancel, etc.
        $grossAmount = $notif->gross_amount ?? 0;
        $paymentType = $notif->payment_type ?? '';
        $fraudStatus = $notif->fraud_status ?? ''; // accept, challenge

        $pembayaran = Pembayaran::where('order_id', $orderId)->first();

        if (!$pembayaran) {
            Log::warning('Midtrans Webhook: Transaksi tidak ditemukan di database', ['order_id' => $orderId]);
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        $currentStatusDB = $pembayaran->status; // Status di DB: pending, diterima, ditolak

        // Tentukan status baru untuk kolom `status` di DB (enum)
        $newStatusDB = $currentStatusDB; // Default tidak berubah

        // Logika update status DB berdasarkan notifikasi Midtrans
        if ($transactionStatus == 'capture' && $fraudStatus == 'accept') {
            $newStatusDB = 'pending'; // Berhasil di Midtrans, set ke 'pending' di DB untuk diverifikasi admin
        } else if ($transactionStatus == 'settlement') {
            $newStatusDB = 'pending'; // Berhasil di Midtrans (settlement), set ke 'pending' di DB untuk diverifikasi admin
        } else if ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
            $newStatusDB = 'ditolak'; // Gagal/batal di Midtrans, set sebagai 'ditolak' di DB
        } else if ($transactionStatus == 'pending' || $transactionStatus == 'challenge' || $transactionStatus == 'authorize') {
            $newStatusDB = 'pending'; // Masih pending di Midtrans, tetap 'pending' di DB
        }
        // Jika webhook datang untuk transaksi yang sudah diterima admin, jangan ubah statusnya di DB
        // (Admin memiliki otoritas final atas status 'diterima' dan 'ditolak')
        if ($currentStatusDB === 'diterima' || $currentStatusDB === 'ditolak') {
            $newStatusDB = $currentStatusDB; // Pertahankan status DB yang sudah final
        }


        // Update pembayaran
        $updateData = [
            'status' => $newStatusDB, // Status DB baru
            'nominal' => $grossAmount, // Update nominal jika ada perubahan (terutama dari notifikasi)
            'gross_amount' => $grossAmount, // Menyimpan juga di kolom gross_amount
            'payment_type' => $paymentType,
            'midtrans_transaction_status_raw' => $transactionStatus, // Simpan status mentah Midtrans di kolom baru
        ];

        // Hanya perbarui jika ada perubahan data
        if ($newStatusDB !== $currentStatusDB ||
            $pembayaran->nominal != $grossAmount ||
            $pembayaran->payment_type != $paymentType ||
            $pembayaran->midtrans_transaction_status_raw != $transactionStatus) {
            $pembayaran->update($updateData);
            Log::info('Midtrans Webhook: Status transaksi diperbarui', ['order_id' => $orderId, 'old_status_db' => $currentStatusDB, 'new_status_db' => $newStatusDB, 'midtrans_raw' => $transactionStatus]);
        } else {
            Log::info('Midtrans Webhook: Status transaksi tidak berubah, atau sudah up-to-date', ['order_id' => $orderId, 'current_status_db' => $currentStatusDB, 'midtrans_raw' => $transactionStatus]);
        }

        return response()->json(['message' => 'Status transaksi diperbarui.'], 200);
    }
}