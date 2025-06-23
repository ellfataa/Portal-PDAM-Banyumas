<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDAM Banyumas - Riwayat Pembayaran</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FFFFFF] text-gray-800 antialiased font-sans">
    <div class="min-h-screen flex flex-col">
        <header class="bg-white text-gray-800 shadow-lg py-4 px-6 md:px-8">
            <div class="max-w-7xl mx-auto flex flex-wrap justify-between items-center">
                <!-- Logo -->
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

                        <!-- Dropdown Menu -->
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

        <!-- Main -->
        <main class="flex-grow py-12 sm:py-16">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                
                <div class="mb-6">
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#1746A2]">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                    </svg>
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Riwayat Pembayaran</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>

                <div class="mb-8">
                    <h2 class="text-3xl font-extrabold text-[#1746A2] mb-2">Riwayat Pembayaran</h2>
                    <p class="text-gray-700 text-lg">Berikut adalah riwayat seluruh pembayaran yang pernah Anda lakukan.</p>
                </div>

                <!-- Content Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    @if($riwayats->count())
                        <!-- Table Header for Desktop -->
                        <div class="hidden md:block">
                            <div class="bg-[#1746A2] text-white px-6 py-4">
                                <div class="grid grid-cols-7 gap-4 text-sm font-semibold uppercase tracking-wider">
                                    <div>Order ID</div>
                                    <div>Metode</div>
                                    <div>Tipe Pembayaran</div>
                                    <div>Jumlah</div>
                                    <div>Status</div>
                                    <div>Tanggal</div>
                                    <div class="text-center">Aksi</div>
                                </div>
                            </div>
                            
                            <div class="divide-y divide-gray-100">
                                @foreach($riwayats as $item)
                                    <div class="px-6 py-4 hover:bg-gray-50 transition duration-150 ease-in-out">
                                        <div class="grid grid-cols-7 gap-4 items-center text-sm">
                                            <div class="font-mono text-gray-900">{{ $item->order_id }}</div>
                                            <div class="capitalize text-gray-700">{{ $item->metode_pembayaran }}</div>
                                            <div class="capitalize text-gray-700">{{ $item->payment_type ?? '-' }}</div>
                                            <div class="font-semibold text-gray-900">Rp{{ number_format($item->gross_amount ?? $item->nominal, 0, ',', '.') }}</div>
                                            <div>
                                                @php
                                                    $displayStatusRiwayat = '';
                                                    $statusColorRiwayat = '';

                                                    if ($item->status === 'diterima') {
                                                        $displayStatusRiwayat = 'Diterima';
                                                        $statusColorRiwayat = 'bg-green-100 text-green-800 border-green-200';
                                                    } elseif ($item->status === 'ditolak') {
                                                        $displayStatusRiwayat = 'Ditolak';
                                                        $statusColorRiwayat = 'bg-red-100 text-red-800 border-red-200';
                                                    } elseif ($item->status === 'pending') {
                                                        if ($item->midtrans_transaction_status_raw === 'settlement' || $item->midtrans_transaction_status_raw === 'capture') {
                                                            $displayStatusRiwayat = 'Pending';
                                                            $statusColorRiwayat = 'bg-yellow-100 text-yellow-800 border-yellow-200';
                                                        } elseif (in_array($item->midtrans_transaction_status_raw, ['pending', 'challenge']) || $item->midtrans_transaction_status_raw === null) {
                                                            $displayStatusRiwayat = 'Belum Bayar';
                                                            $statusColorRiwayat = 'bg-orange-100 text-orange-800 border-orange-200';
                                                        } else {
                                                            $displayStatusRiwayat = ucfirst($item->status);
                                                            $statusColorRiwayat = 'bg-gray-100 text-gray-800 border-gray-200';
                                                        }
                                                    } else {
                                                        $displayStatusRiwayat = ucfirst($item->status);
                                                        $statusColorRiwayat = 'bg-gray-100 text-gray-800 border-gray-200';
                                                    }
                                                @endphp
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border {{ $statusColorRiwayat }}">
                                                    {{ $displayStatusRiwayat }}
                                                </span>
                                            </div>
                                            <div class="text-gray-700">{{ $item->created_at->translatedFormat('d M Y') }}</div>
                                            <div class="text-center">
                                                <a href="{{ route('pembayaran.cek', ['order_id' => $item->order_id]) }}"
                                                   class="inline-flex items-center px-3 py-2 bg-[#5F9DF7] text-white text-xs font-medium rounded-lg hover:bg-opacity-80 transition duration-300 ease-in-out transform hover:scale-105">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    Detail
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Mobile Cards -->
                        <div class="md:hidden divide-y divide-gray-100">
                            @foreach($riwayats as $item)
                                <div class="p-6 space-y-3">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase tracking-wide font-medium mb-1">Order ID</p>
                                            <p class="font-mono text-sm font-medium text-gray-900">{{ $item->order_id }}</p>
                                        </div>
                                        <div>
                                            @php
                                                $displayStatusRiwayat = '';
                                                $statusColorRiwayat = '';

                                                if ($item->status === 'diterima') {
                                                    $displayStatusRiwayat = 'Diterima';
                                                    $statusColorRiwayat = 'bg-green-100 text-green-800 border-green-200';
                                                } elseif ($item->status === 'ditolak') {
                                                    $displayStatusRiwayat = 'Ditolak';
                                                    $statusColorRiwayat = 'bg-red-100 text-red-800 border-red-200';
                                                } elseif ($item->status === 'pending') {
                                                    if ($item->midtrans_transaction_status_raw === 'settlement' || $item->midtrans_transaction_status_raw === 'capture') {
                                                        $displayStatusRiwayat = 'Pending';
                                                        $statusColorRiwayat = 'bg-yellow-100 text-yellow-800 border-yellow-200';
                                                    } elseif (in_array($item->midtrans_transaction_status_raw, ['pending', 'challenge']) || $item->midtrans_transaction_status_raw === null) {
                                                        $displayStatusRiwayat = 'Belum Bayar';
                                                        $statusColorRiwayat = 'bg-orange-100 text-orange-800 border-orange-200';
                                                    } else {
                                                        $displayStatusRiwayat = ucfirst($item->status);
                                                        $statusColorRiwayat = 'bg-gray-100 text-gray-800 border-gray-200';
                                                    }
                                                } else {
                                                    $displayStatusRiwayat = ucfirst($item->status);
                                                    $statusColorRiwayat = 'bg-gray-100 text-gray-800 border-gray-200';
                                                }
                                            @endphp
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium border {{ $statusColorRiwayat }}">
                                                {{ $displayStatusRiwayat }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase tracking-wide font-medium mb-1">Metode</p>
                                            <p class="text-sm text-gray-900 capitalize">{{ $item->metode_pembayaran }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase tracking-wide font-medium mb-1">Tipe</p>
                                            <p class="text-sm text-gray-900 capitalize">{{ $item->payment_type ?? '-' }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase tracking-wide font-medium mb-1">Jumlah</p>
                                            <p class="text-sm font-semibold text-gray-900">Rp{{ number_format($item->gross_amount ?? $item->nominal, 0, ',', '.') }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase tracking-wide font-medium mb-1">Tanggal</p>
                                            <p class="text-sm text-gray-900">{{ $item->created_at->translatedFormat('d M Y') }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="pt-3 border-t border-gray-100">
                                        <a href="{{ route('pembayaran.cek', ['order_id' => $item->order_id]) }}"
                                           class="w-full inline-flex justify-center items-center px-4 py-2 bg-[#5F9DF7] text-white text-sm font-medium rounded-lg hover:bg-opacity-80 transition duration-300 ease-in-out">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-16">
                            <svg class="mx-auto h-16 w-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Riwayat Pembayaran</h3>
                            <p class="text-gray-500 mb-6">Anda belum memiliki riwayat pembayaran yang tercatat dalam sistem.</p>
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-[#1746A2] text-white text-sm font-medium rounded-lg hover:bg-opacity-80 transition duration-300 ease-in-out">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Kembali ke Dashboard
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </main>

        <footer class="bg-[#1746A2] text-white text-center py-5 text-sm font-light">
            <div class="max-w-7xl mx-auto px-6">
                &copy; {{ date('Y') }} PDAM Banyumas. Seluruh hak cipta dilindungi.
            </div>
        </footer>
    </div>
</body>
</html>