<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\PendaftaranPelanggan;
use App\Models\User;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Menampilkan dashboard admin dengan data statistik dan aktivitas terkini.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $totalPendaftaran = PendaftaranPelanggan::count();
        $pembayaranPending = Pembayaran::where('status', 'pending')->count();
        $pembayaranSuccess = Pembayaran::where('status', 'diterima')->count();
        $totalRevenue = Pembayaran::where('status', 'diterima')->sum('nominal');

        $recentPayments = Pembayaran::select(
                'id',
                DB::raw("'payment' as type"),
                'order_id as reference_id',
                'nominal as amount',
                'status',
                'created_at'
            )
            ->with('user')
            ->latest()
            ->limit(5);

        $recentRegistrations = PendaftaranPelanggan::select(
                'id',
                DB::raw("'registration' as type"),
                'nama_lengkap as reference_id',
                DB::raw("0 as amount"), // Tidak ada nominal spesifik untuk pendaftaran
                DB::raw("'completed' as status"), // Pendaftaran dianggap 'completed' sekali disimpan
                'created_at'
            )
            ->with('user')
            ->latest()
            ->limit(5);

        $recentActivities = $recentPayments->union($recentRegistrations)
                                            ->orderByDesc('created_at')
                                            ->get();

        return view('admin.dashboard', compact(
            'totalPendaftaran',
            'pembayaranPending',
            'pembayaranSuccess',
            'totalRevenue',
            'recentActivities'
        ));
    }

    /**
     * Menampilkan halaman untuk mengelola data pelanggan (PendaftaranPelanggan).
     *
     * @return \Illuminate\View\View
     */
    public function kelolaPelanggan()
    {
        // Ambil semua data PendaftaranPelanggan dan muat relasi user, kecamatan, dan kelurahan
        $pendaftarans = PendaftaranPelanggan::with(['user', 'kecamatan', 'kelurahan'])
                                            ->latest()
                                            ->get();
        // Mengirimkan $pendaftarans ke view dengan nama 'pelanggans' agar konsisten dengan view Anda
        return view('admin.pelanggan.index', compact('pendaftarans'));
    }

    /**
     * Menampilkan form untuk mengedit data pelanggan (PendaftaranPelanggan).
     *
     * @param int $id ID PendaftaranPelanggan
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function editPelanggan($id)
    {
        // Cari PendaftaranPelanggan berdasarkan ID, muat relasi user, kecamatan, dan kelurahan
        $pendaftaran = PendaftaranPelanggan::with(['user', 'kecamatan', 'kelurahan'])->findOrFail($id);

        $kecamatans = Kecamatan::orderBy('nama')->get();
        $kelurahans = collect(); // Inisialisasi kosong

        // Jika ada kecamatan_id, muat kelurahan yang relevan
        if ($pendaftaran->kecamatan_id) {
            $kelurahans = Kelurahan::where('kecamatan_id', $pendaftaran->kecamatan_id)
                                    ->orderBy('nama')
                                    ->get();
        }

        // Mengirimkan $pendaftaran ke view dengan nama 'user' agar konsisten dengan form edit Anda
        return view('admin.pelanggan.edit', compact('pendaftaran', 'kecamatans', 'kelurahans'));
    }

    /**
     * Memperbarui data pelanggan (PendaftaranPelanggan) di database.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id ID PendaftaranPelanggan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePelanggan(Request $request, $id)
    {
        $pendaftaran = PendaftaranPelanggan::with('user')->findOrFail($id);

        $request->validate([
            'nama_lengkap'   => 'required|string|max:255', // Nama lengkap dari pendaftaran
            'email'          => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($pendaftaran->user_id)], // Email user terkait
            'password'       => 'nullable|string|min:8|confirmed',
            'pekerjaan'      => 'nullable|string|max:255',
            'kecamatan_id'   => 'nullable|exists:kecamatans,id',
            'kelurahan_id'   => 'nullable|exists:kelurahans,id',
            'latitude'       => 'nullable|numeric',
            'longitude'      => 'nullable|numeric',
            'foto_rumah'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_ktp'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update data user terkait
        $user = $pendaftaran->user;
        if ($user) {
            $user->name = $request->nama_lengkap; // Update nama user dari nama_lengkap pendaftaran
            $user->email = $request->email;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
        }

        // Update data PendaftaranPelanggan
        $pendaftaran->fill([
            'nama_lengkap'   => $request->nama_lengkap,
            'pekerjaan'      => $request->pekerjaan,
            'kecamatan_id'   => $request->kecamatan_id,
            'kelurahan_id'   => $request->kelurahan_id,
            'latitude'       => $request->latitude,
            'longitude'      => $request->longitude,
        ]);

        // Tangani upload foto jika ada
        if ($request->hasFile('foto_rumah')) {
            if ($pendaftaran->foto_rumah && Storage::disk('public')->exists($pendaftaran->foto_rumah)) {
                Storage::disk('public')->delete($pendaftaran->foto_rumah);
            }
            $pendaftaran->foto_rumah = $request->file('foto_rumah')->store('uploads/rumah', 'public');
        }
        if ($request->hasFile('foto_ktp')) {
            if ($pendaftaran->foto_ktp && Storage::disk('public')->exists($pendaftaran->foto_ktp)) {
                Storage::disk('public')->delete($pendaftaran->foto_ktp);
            }
            $pendaftaran->foto_ktp = $request->file('foto_ktp')->store('uploads/ktp', 'public');
        }

        $pendaftaran->save();

        return redirect()->route('admin.pelanggan.index')->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    /**
     * Menghapus data pelanggan (PendaftaranPelanggan) dari database.
     * Catatan: Ini hanya akan menghapus record PendaftaranPelanggan, bukan akun User-nya.
     * Untuk menghapus User dan semua data terkait, Anda perlu memodifikasi ini.
     *
     * @param int $id ID PendaftaranPelanggan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyPelanggan($id)
    {
        $pendaftaran = PendaftaranPelanggan::with('user', 'pembayarans')->findOrFail($id);

        // Hapus file foto terkait pendaftaran (jika ada)
        if ($pendaftaran->foto_rumah && Storage::disk('public')->exists($pendaftaran->foto_rumah)) {
            Storage::disk('public')->delete($pendaftaran->foto_rumah);
        }
        if ($pendaftaran->foto_ktp && Storage::disk('public')->exists($pendaftaran->foto_ktp)) {
            Storage::disk('public')->delete($pendaftaran->foto_ktp);
        }

        // Hapus pembayaran yang terkait langsung dengan PendaftaranPelanggan ini
        // Jika ada pembayaran yang hanya terkait user tapi tidak langsung pendaftaran ini,
        // itu tidak akan terhapus.
        $pendaftaran->pembayarans()->delete();

        // Hapus record pendaftaran itu sendiri
        $pendaftaran->delete();

        return redirect()->route('admin.pelanggan.index')->with('success', 'Data pendaftaran pelanggan berhasil dihapus.');
    }


    /**
     * Menampilkan halaman laporan keuangan.
     *
     * @return \Illuminate\View\View
     */
    public function laporanKeuangan()
    {
        $monthlyRevenue = Pembayaran::select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(nominal) as total_nominal')
            )
            ->where('status', 'diterima')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        return view('admin.laporan.keuangan', compact('monthlyRevenue'));
    }
}

