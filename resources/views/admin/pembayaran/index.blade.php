<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDAM Banyumas - Verifikasi Pembayaran</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FFFFFF] text-gray-800 antialiased font-sans">
    <div class="min-h-screen flex flex-col">

        <header class="bg-white text-gray-800 shadow-lg py-4 px-6 md:px-8">
            <div class="max-w-7xl mx-auto flex flex-wrap justify-between items-center">
                <div class="flex items-center space-x-3 sm:space-x-4 mb-2 md:mb-0">
                    <img src="{{ asset('images/logo-pdam.png') }}" alt="Logo PDAM Banyumas" class="h-10 w-25 sm:h-12 sm:w-27">
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-[#1746A2]">PDAM Banyumas</h1>
                </div>

                <nav class="w-full md:w-auto flex justify-center md:justify-end items-center space-x-4 sm:space-x-6 text-base font-medium relative">
                    <div x-data="{ open: false }" @click.away="open = false" class="relative">
                        <button @click="open = !open" class="flex items-center text-gray-700 hover:text-[#1746A2] focus:outline-none focus:ring-2 focus:ring-[#5F9DF7] focus:ring-opacity-50 px-3 py-2 rounded-lg transition duration-300 ease-in-out">
                            Halo, {{ Auth::user()->name }}
                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            style="display: none;">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition duration-150 ease-in-out">Profil</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition duration-150 ease-in-out">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </nav>
            </div>
        </header>

        <main class="flex-grow py-12 sm:py-16">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <!-- Tombol Kembali -->
                <div class="mb-4 text-start w-full">
                    <a href="{{ url('/dashboard') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-[#1746A2] transition duration-300 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Dashboard
                    </a>
                </div>

                <h2 class="text-3xl font-extrabold text-[#1746A2] mb-8 text-center">Verifikasi Pembayaran</h2>

                @if(session('success'))
                    <div class="mb-6 p-4 sm:p-5 bg-green-100 text-green-700 rounded-xl border border-green-200 font-medium text-center">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto text-sm text-gray-700">
                            <thead>
                                <tr class="bg-[#F0F7FF] text-[#1746A2] uppercase text-left text-xs font-semibold tracking-wider">
                                    <th class="px-4 py-3 rounded-tl-lg">User</th>
                                    <th class="px-4 py-3">Order ID</th>
                                    <th class="px-4 py-3">Metode</th>
                                    <th class="px-4 py-3">Tipe Pembayaran</th>
                                    <th class="px-4 py-3 text-right">Nominal</th>
                                    <th class="px-4 py-3 text-center">Status DB</th>
                                    <th class="px-4 py-3 text-center">Status Midtrans (Raw)</th>
                                    <th class="px-4 py-3 rounded-tr-lg text-center">Aksi Admin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pembayarans as $pembayaran)
                                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                                        <td class="px-4 py-3 font-medium">{{ $pembayaran->user->name }}</td>
                                        <td class="px-4 py-3 font-mono text-gray-600">{{ $pembayaran->order_id }}</td>
                                        <td class="px-4 py-3">{{ $pembayaran->metode_pembayaran }}</td>
                                        <td class="px-4 py-3 capitalize">{{ $pembayaran->payment_type ?? '-' }}</td>
                                        <td class="px-4 py-3 text-right font-semibold">Rp{{ number_format($pembayaran->gross_amount ?? $pembayaran->nominal, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 text-center">
                                            @php
                                                $adminStatusText = '';
                                                $adminStatusColor = '';

                                                if ($pembayaran->status === 'diterima') {
                                                    $adminStatusText = 'Diterima';
                                                    $adminStatusColor = 'bg-green-100 text-green-700 border border-green-200';
                                                } elseif ($pembayaran->status === 'ditolak') {
                                                    $adminStatusText = 'Ditolak';
                                                    $adminStatusColor = 'bg-red-100 text-red-700 border border-red-200';
                                                } elseif ($pembayaran->status === 'pending') {
                                                    $adminStatusText = 'Pending (Verifikasi)';
                                                    $adminStatusColor = 'bg-yellow-100 text-yellow-700 border border-yellow-200';
                                                } else {
                                                    $adminStatusText = ucfirst($pembayaran->status);
                                                    $adminStatusColor = 'bg-gray-100 text-gray-700 border border-gray-200';
                                                }
                                            @endphp
                                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $adminStatusColor }}">
                                                {{ $adminStatusText }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-xs font-mono text-gray-600 text-center">
                                            {{ $pembayaran->midtrans_transaction_status_raw ?? '-' }}
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            @if($pembayaran->status === 'pending')
                                                <form method="POST" action="{{ route('admin.pembayaran.terima', $pembayaran->id) }}" class="inline-block mr-2">
                                                    @csrf
                                                    <button type="submit" class="bg-[#1746A2] text-white px-4 py-2 rounded-lg hover:bg-opacity-90 transition duration-300 ease-in-out text-xs font-semibold shadow-sm">
                                                        Terima
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('admin.pembayaran.tolak', $pembayaran->id) }}" class="inline-block">
                                                    @csrf
                                                    <button type="submit" class="bg-[#FF731D] text-white px-4 py-2 rounded-lg hover:bg-opacity-90 transition duration-300 ease-in-out text-xs font-semibold shadow-sm">
                                                        Tolak
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-sm text-gray-500 italic">Sudah diverifikasi</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-gray-500 py-6">Belum ada data pembayaran yang perlu diverifikasi.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>

        <footer class="bg-[#1746A2] text-white text-center py-5 text-sm font-light mt-auto">
            <div class="max-w-7xl mx-auto px-6">
                &copy; {{ date('Y') }} PDAM Banyumas. Seluruh hak cipta dilindungi.
            </div>
        </footer>
    </div>
</body>
</html>