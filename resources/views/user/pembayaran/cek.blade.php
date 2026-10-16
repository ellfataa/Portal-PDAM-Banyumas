<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDAM Banyumas - Cek Status Pembayaran</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 antialiased font-sans min-w-[1024px]">
    <div class="min-h-screen flex flex-col">

        <!-- Header Section -->
        <header class="bg-white shadow-sm py-3 px-12 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('images/logo-pdam.png') }}" alt="Logo PDAM Banyumas" class="h-10 w-auto">
                    <h1 class="text-2xl font-extrabold tracking-tight text-[#1746A2]">PDAM Banyumas</h1>
                </div>

                <nav class="flex items-center space-x-6 text-base font-semibold">
                    <div x-data="{ open: false }" @click.away="open = false" class="relative">
                        <button @click="open = !open" class="flex items-center space-x-2 text-[#1746A2] hover:text-[#5F9DF7] px-4 py-2 transition duration-300 focus:outline-none">
                            <span>Halo, {{ Auth::user()->name }}</span>
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 z-50 mt-2 w-48 bg-white rounded-xl shadow-lg py-2 border border-gray-100"
                            style="display: none;">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 font-medium hover:bg-blue-50 hover:text-[#1746A2] transition duration-150">Profil Akun</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 font-medium hover:bg-red-50 transition duration-150">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </nav>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow py-12 px-12">
            <div class="max-w-7xl mx-auto space-y-8 animate-fade-in-up">

                <div class="mb-4">
                    <a href="{{ route('user.home') }}" class="inline-flex items-center text-sm font-semibold text-gray-500 hover:text-[#1746A2] transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Dashboard
                    </a>
                </div>

                <div class="p-10 bg-white shadow-xl border border-gray-100 rounded-[2rem]">
                    <header class="mb-8 border-b border-gray-100 pb-6 flex items-center justify-between">
                        <div>
                            <h2 class="text-3xl font-extrabold text-[#1746A2] mb-2">
                                Tagihan Aktif Anda
                            </h2>
                            <p class="text-lg text-gray-500 font-medium">
                                Daftar tagihan pendaftaran yang menunggu pembayaran atau verifikasi.
                            </p>
                        </div>
                        <div class="bg-blue-50 p-4 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#5F9DF7]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </header>

                    @php
                        $noticeColors = [
                            'success' => 'border-green-200 bg-green-50 text-green-800',
                            'error' => 'border-red-200 bg-red-50 text-red-800',
                            'warning' => 'border-yellow-200 bg-yellow-50 text-yellow-800',
                            'info' => 'border-blue-200 bg-blue-50 text-blue-800',
                        ];
                        $iconSvgs = [
                            'success' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />',
                            'error' => '<path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />',
                            'warning' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />',
                            'info' => '<path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />',
                        ];
                    @endphp

                    @if ($message)
                        <div class="mb-8 p-6 rounded-2xl border flex items-start {{ $noticeColors[$messageType] ?? $noticeColors['info'] }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                {!! $iconSvgs[$messageType] ?? $iconSvgs['info'] !!}
                            </svg>
                            <p class="font-medium text-sm leading-relaxed">{{ $message }}</p>
                        </div>
                    @endif

                    <!-- MEMULAI LOOPING SEMUA TAGIHAN -->
                    @forelse ($pendingPayments as $payment)
                        @php
                            $rawStatus = $payment->midtrans_transaction_status_raw;
                            $canPay = true;

                            if (in_array($rawStatus, ['settlement', 'capture'])) {
                                $statusText = 'Menunggu Konfirmasi Admin';
                                $statusBadge = 'bg-yellow-100 text-yellow-800 border-yellow-200';
                                $canPay = false;
                            } else {
                                $statusText = 'Belum Dibayar';
                                $statusBadge = 'bg-orange-100 text-orange-800 border-orange-200';
                                $canPay = true;
                            }
                        @endphp

                        <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6 mb-6">
                            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-5">
                                <div>
                                    <dt class="text-sm font-semibold text-gray-500 mb-1">Order ID</dt>
                                    <dd class="text-sm font-bold text-gray-900 bg-white border border-gray-200 py-1 px-3 rounded-lg inline-block">{{ $payment->order_id }}</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-semibold text-gray-500 mb-1">Status Pembayaran</dt>
                                    <dd class="mt-1">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold border {{ $statusBadge }}">
                                            {{ $statusText }}
                                        </span>
                                    </dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-semibold text-gray-500 mb-1">Nominal Tagihan</dt>
                                    <dd class="text-lg font-extrabold text-[#FF731D]">Rp {{ number_format($payment->nominal, 0, ',', '.') }}</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-semibold text-gray-500 mb-1">Tanggal Dibuat</dt>
                                    <dd class="text-sm font-medium text-gray-900">{{ $payment->created_at?->setTimezone('Asia/Jakarta')->format('d M Y - H:i') }} WIB</dd>
                                </div>
                            </dl>

                            <!-- Tombol Aksi per Transaksi -->
                            <div class="flex items-center justify-end gap-3 pt-5 mt-5 border-t border-gray-200">
                                @if ($canPay)
                                    <a href="{{ route('pembayaran.snap', ['order_id' => $payment->order_id]) }}" class="bg-[#FF731D] hover:bg-[#e06518] text-white font-bold px-6 py-2 rounded-xl shadow-md transition duration-300 flex items-center text-sm">
                                        Bayar Sekarang
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 border-2 border-dashed border-gray-200 rounded-2xl">
                            <div class="bg-gray-100 w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-700 mb-1">Tidak Ada Tagihan Aktif</h3>
                            <p class="text-sm text-gray-500 mb-6">Semua tagihan pendaftaran Anda sudah lunas atau belum ada tagihan baru.</p>
                        </div>
                    @endforelse

                    <div class="flex justify-center mt-8 pt-6 border-t border-gray-100">
                        <a href="{{ route('pembayaran.riwayat') }}" class="bg-white border-2 border-gray-200 hover:border-[#1746A2] hover:text-[#1746A2] text-gray-600 font-bold px-8 py-3 rounded-xl transition duration-300 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Lihat Riwayat Lengkap (Lunas & Ditolak)
                        </a>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer Section -->
        <footer class="bg-[#1746A2] text-white text-center py-6 text-base font-light mt-auto">
            <div class="max-w-7xl mx-auto px-12">
                &copy; {{ date('Y') }} PDAM Banyumas. Seluruh hak cipta dilindungi.
            </div>
        </footer>
    </div>

    <!-- Styles -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        body { font-family: 'Inter', sans-serif; }
    </style>
</body>
</html>
