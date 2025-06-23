<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDAM Banyumas - Status Pembayaran</title>
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
                                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Status Pembayaran</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>

                <div class="mb-8">
                    <h2 class="text-3xl font-extrabold text-[#1746A2] mb-2">Status Pembayaran</h2>
                    <p class="text-gray-700 text-lg">Periksa status pembayaran terbaru Anda di sini.</p>
                </div>

                {{-- Tampilkan pesan dari controller --}}
                @if ($message)
                    <div class="mb-6 p-4 sm:p-5 rounded-xl border font-medium
                        @if($messageType === 'success') bg-green-50 text-green-800 border-green-200
                        @elseif($messageType === 'info') bg-blue-50 text-blue-800 border-blue-200
                        @elseif($messageType === 'warning') bg-yellow-50 text-yellow-800 border-yellow-200
                        @elseif($messageType === 'error') bg-red-50 text-red-800 border-red-200
                        @endif">
                        <div class="flex items-start">
                            @if($messageType === 'success')
                                <svg class="h-5 w-5 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            @elseif($messageType === 'info')
                                <svg class="h-5 w-5 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                            @elseif($messageType === 'warning')
                                <svg class="h-5 w-5 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                            @elseif($messageType === 'error')
                                <svg class="h-5 w-5 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            @endif
                            <div>{!! $message !!}</div>
                        </div>
                    </div>
                @endif

                <!-- Content Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    @if($payment)
                        <!-- Payment Details for Desktop -->
                        <div class="hidden md:block">
                            <div class="bg-[#1746A2] text-white px-6 py-4">
                                <div class="grid grid-cols-5 gap-4 text-sm font-semibold uppercase tracking-wider">
                                    <div>Order ID</div>
                                    <div>Metode</div>
                                    <div>Jumlah</div>
                                    <div>Status</div>
                                    <div class="text-center">Aksi</div>
                                </div>
                            </div>
                            
                            <div class="p-6">
                                <div class="grid grid-cols-5 gap-4 items-center">
                                    <div class="font-mono text-sm text-gray-900">{{ $payment->order_id }}</div>
                                    <div class="text-sm text-gray-700 capitalize">{{ $payment->metode_pembayaran }}</div>
                                    <div class="text-sm font-semibold text-gray-900">Rp{{ number_format($payment->gross_amount ?? $payment->nominal, 0, ',', '.') }}</div>
                                    <div>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border
                                            @if($displayStatus === 'Diterima') bg-green-100 text-green-800 border-green-200
                                            @elseif($displayStatus === 'Pending') bg-yellow-100 text-yellow-800 border-yellow-200
                                            @elseif($displayStatus === 'Belum Bayar') bg-orange-100 text-orange-800 border-orange-200
                                            @elseif($displayStatus === 'Ditolak') bg-red-100 text-red-800 border-red-200
                                            @else bg-gray-100 text-gray-800 border-gray-200 @endif">
                                            {{ $displayStatus }}
                                        </span>
                                    </div>
                                    <div class="text-center">
                                        @if($actionButton === 'Lanjutkan Pembayaran')
                                            <a href="{{ route('pembayaran.snap', ['order_id' => $payment->order_id]) }}"
                                               class="inline-flex items-center px-4 py-2 bg-[#FF731D] text-white text-sm font-medium rounded-lg hover:bg-opacity-80 transition duration-300 ease-in-out transform hover:scale-105">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                                Lanjutkan Pembayaran
                                            </a>
                                        @else
                                            <a href="{{ route('pembayaran.riwayat') }}"
                                               class="inline-flex items-center px-4 py-2 bg-[#5F9DF7] text-white text-sm font-medium rounded-lg hover:bg-opacity-80 transition duration-300 ease-in-out transform hover:scale-105">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                </svg>
                                                Lihat Riwayat
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Details for Mobile -->
                        <div class="md:hidden p-6">
                            <div class="space-y-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide font-medium mb-1">Order ID</p>
                                        <p class="font-mono text-sm font-medium text-gray-900">{{ $payment->order_id }}</p>
                                    </div>
                                    <div>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium border
                                            @if($displayStatus === 'Diterima') bg-green-100 text-green-800 border-green-200
                                            @elseif($displayStatus === 'Pending') bg-yellow-100 text-yellow-800 border-yellow-200
                                            @elseif($displayStatus === 'Belum Bayar') bg-orange-100 text-orange-800 border-orange-200
                                            @elseif($displayStatus === 'Ditolak') bg-red-100 text-red-800 border-red-200
                                            @else bg-gray-100 text-gray-800 border-gray-200 @endif">
                                            {{ $displayStatus }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide font-medium mb-1">Metode</p>
                                        <p class="text-sm text-gray-900 capitalize">{{ $payment->metode_pembayaran }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide font-medium mb-1">Jumlah</p>
                                        <p class="text-sm font-semibold text-gray-900">Rp{{ number_format($payment->gross_amount ?? $payment->nominal, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                
                                <div class="pt-4 border-t border-gray-100">
                                    @if($actionButton === 'Lanjutkan Pembayaran')
                                        <a href="{{ route('pembayaran.snap', ['order_id' => $payment->order_id]) }}"
                                           class="w-full inline-flex justify-center items-center px-4 py-3 bg-[#FF731D] text-white text-sm font-medium rounded-lg hover:bg-opacity-80 transition duration-300 ease-in-out">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            Lanjutkan Pembayaran
                                        </a>
                                    @else
                                        <a href="{{ route('pembayaran.riwayat') }}"
                                           class="w-full inline-flex justify-center items-center px-4 py-3 bg-[#5F9DF7] text-white text-sm font-medium rounded-lg hover:bg-opacity-80 transition duration-300 ease-in-out">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                            Lihat Riwayat
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons Section -->
                        <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
                            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                                <a href="{{ route('pembayaran.riwayat') }}"
                                   class="inline-flex items-center justify-center px-6 py-3 bg-[#1746A2] text-white text-sm font-medium rounded-lg hover:bg-opacity-80 transition duration-300 ease-in-out transform hover:scale-105">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    Lihat Semua Riwayat Pembayaran
                                </a>
                            </div>
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-16">
                            <svg class="mx-auto h-16 w-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 4h.01M9 16h.01" />
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak Ada Transaksi</h3>
                            <p class="text-gray-500 mb-6">Tidak ada transaksi pembayaran spesifik yang ditampilkan saat ini.</p>
                            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                                <a href="{{ route('pembayaran.riwayat') }}"
                                   class="inline-flex items-center justify-center px-6 py-3 bg-[#5F9DF7] text-white text-sm font-medium rounded-lg hover:bg-opacity-80 transition duration-300 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    Lihat Riwayat Pembayaran
                                </a>
                                <a href="{{ route('dashboard') }}"
                                   class="inline-flex items-center justify-center px-6 py-3 bg-[#1746A2] text-white text-sm font-medium rounded-lg hover:bg-opacity-80 transition duration-300 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                    </svg>
                                    Kembali ke Dashboard
                                </a>
                            </div>
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