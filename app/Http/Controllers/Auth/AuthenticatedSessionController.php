<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();
        $tujuan = $user->role === 'admin' ? route('admin.dashboard') : route('user.home');

        // PERBAIKAN: Gunakan redirect langsung ke variabel $tujuan, hapus intended()
        return redirect($tujuan)->with('success', 'Selamat datang kembali, ' . $user->name . '!');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // PERBAIKAN: Gunakan route('welcome') dibandingkan url string '/'
        return redirect()->route('welcome')->with('success', 'Anda telah berhasil keluar dari sistem.');
    }
}
