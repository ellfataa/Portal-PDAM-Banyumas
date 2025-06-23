<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDAM Banyumas - Pembayaran</title>
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
        <main class="flex-grow py-5 sm:py-10">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                
                <div class="mb-6">
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#1746A2] transition duration-300">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                    </svg>
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Pembayaran</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>

                <!-- Payment Section -->
                <div class="max-w-2xl mx-auto">
                    <!-- Header -->
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-extrabold text-[#1746A2] mb-2">Pembayaran</h2>
                        <p class="text-gray-600">Selesaikan pembayaran Anda dengan aman dan mudah</p>
                    </div>

                    <!-- Payment Card -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                        <!-- Payment Icon Header -->
                        <div class="bg-gradient-to-r from-[#1746A2] to-[#5F9DF7] px-6 py-8 text-center">
                            <div class="inline-flex items-center justify-center w-20 h-20 bg-white bg-opacity-20 rounded-full mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white">Proses Pembayaran</h3>
                        </div>

                        <!-- Payment Content -->
                        <div class="p-6 sm:p-8">
                            @if(empty($snapToken))
                                <!-- Error State -->
                                <div class="text-center">
                                    <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                        </svg>
                                    </div>
                                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Gagal Memuat Token Pembayaran</h4>
                                    <p class="text-gray-600 mb-6">Maaf, terjadi kesalahan saat memuat token pembayaran. Silakan coba lagi.</p>
                                    
                                    <a href="{{ route('pembayaran.cek') }}" 
                                       class="inline-flex items-center justify-center bg-gray-600 text-white px-6 py-3 rounded-xl shadow-md hover:bg-gray-700 transition duration-300 ease-in-out transform hover:scale-105 font-semibold">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                        </svg>
                                        Kembali
                                    </a>
                                </div>
                            @else
                                <!-- Success State -->
                                <div class="text-center">
                                    <!-- Debug Info (hidden in production) -->
                                    @if(config('app.debug'))
                                        <div class="mb-4 p-3 bg-gray-50 rounded-lg border">
                                            <p class="text-xs text-gray-500">Debug - Snap Token: {{ $snapToken }}</p>
                                        </div>
                                    @endif

                                    <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    
                                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Siap untuk Pembayaran</h4>
                                    <p class="text-gray-600 mb-6">Token pembayaran telah berhasil dimuat. Klik tombol di bawah untuk melanjutkan proses pembayaran Anda.</p>

                                    <button id="pay-button"
                                            class="inline-flex items-center justify-center bg-gradient-to-r from-green-600 to-green-700 text-white px-8 py-4 rounded-xl shadow-lg hover:from-green-700 hover:to-green-800 transition duration-300 ease-in-out transform hover:scale-105 font-semibold text-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        Bayar Sekarang
                                    </button>
                                </div>

                                <!-- Security Notice -->
                                <div class="mt-8 p-4 bg-blue-50 rounded-xl border border-blue-200">
                                    <div class="flex items-start space-x-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                        <div>
                                            <h5 class="font-semibold text-blue-900 mb-1">Pembayaran Aman</h5>
                                            <p class="text-sm text-blue-800">Transaksi Anda dilindungi dengan enkripsi SSL dan diproses melalui gateway pembayaran yang aman dan terpercaya.</p>
                                        </div>
                                    </div>
                                </div>

                                {{--
                                    Form ini disembunyikan dan tidak akan digunakan lagi untuk submit otomatis
                                    dari JS Snap callbacks. Callback Midtrans (webhook server-to-server)
                                    adalah cara utama untuk update status.
                                --}}
                                <form id="midtrans-form" action="{{ route('midtrans.callback') }}" method="POST" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="order_id" id="order_id">
                                    <input type="hidden" name="transaction_status" id="transaction_status">
                                    <input type="hidden" name="gross_amount" id="gross_amount">
                                    <input type="hidden" name="payment_type" id="payment_type">
                                </form>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </main>

        <footer class="bg-[#1746A2] text-white text-center py-5 text-sm font-light">
            <div class="max-w-7xl mx-auto px-6">
                &copy; {{ date('Y') }} PDAM Banyumas. Seluruh hak cipta dilindungi.
            </div>
        </footer>
    </div>

    @if(!empty($snapToken))
        {{-- Snap.js CDN --}}
        <script src="https://app.{{ config('midtrans.is_production') ? 'midtrans' : 'sandbox.midtrans' }}.com/snap/snap.js"
                data-client-key="{{ config('midtrans.client_key') }}"></script>

        <script>
            document.getElementById('pay-button').addEventListener('click', function () {
                snap.pay('{{ $snapToken }}', {
                    onSuccess: function (result) {
                        // Redirect langsung ke halaman cek pembayaran dengan parameter dari Midtrans.
                        // Midtrans webhook akan bertanggung jawab untuk update status di database.
                        alert('Pembayaran berhasil! Sistem sedang memproses konfirmasi.');
                        window.location.href = "{{ route('pembayaran.cek') }}?order_id=" + result.order_id + "&transaction_status=" + result.transaction_status + "&status_code=" + result.status_code;
                    },
                    onPending: function (result) {
                        alert('Pembayaran tertunda. Silakan selesaikan pembayaran sesuai instruksi.');
                        window.location.href = "{{ route('pembayaran.cek') }}?order_id=" + result.order_id + "&transaction_status=" + result.transaction_status + "&status_code=" + result.status_code;
                    },
                    onError: function (result) {
                        alert('Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi.');
                        console.error('Midtrans Error:', result);
                        window.location.href = "{{ route('pembayaran.cek') }}?order_id=" + result.order_id + "&transaction_status=" + result.transaction_status + "&status_code=" + result.status_code;
                    },
                    onClose: function () {
                        // Pengguna menutup popup tanpa menyelesaikan pembayaran
                        alert('Anda menutup popup sebelum menyelesaikan pembayaran. Silakan cek status pembayaran Anda.');
                        window.location.href = "{{ route('pembayaran.cek') }}"; // Redirect ke halaman cek status
                    }
                });
            });
        </script>
    @endif
</body>
</html>