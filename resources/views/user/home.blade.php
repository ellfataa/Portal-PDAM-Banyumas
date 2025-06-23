<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDAM Banyumas - Dashboard Pengguna</title>
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
            <div class="max-w-7xl mx-auto px-6 lg:px-8"> {{-- Adjusted px/py for direct content --}}
                <p class="text-gray-700 mb-6 text-lg">
                    Selamat datang, {{ Auth::user()->name }}! Berikut adalah layanan yang tersedia untuk Anda:
                </p>

                @php
                    // Get the authenticated user
                    $user = Auth::user();
                    // Count the number of customer registrations for the user
                    $jumlahPendaftaran = $user->pendaftarans()->count();
                @endphp

                {{-- Conditional messages based on customer registration status --}}
                @if($jumlahPendaftaran === 0)
                    <!-- Menampilkan pesan bahwa pelanggan belum mendaftar -->
                    <div class="mb-6 p-4 sm:p-5 bg-[#5F9DF7] bg-opacity-10 text-[#1746A2] rounded-xl border border-[#5F9DF7] font-medium text-center">
                        <p class="text-lg mb-1">Anda belum mendaftar sebagai pelanggan.</p>
                        <p>Silakan isi formulir pendaftaran pelanggan untuk dapat melanjutkan ke proses pembayaran.</p>
                    </div>
                @else
                    <!-- Menampilkan pesan bahwa pelanggan sudah mendaftar -->
                    <div class="mb-6 p-4 sm:p-5 bg-[#FF731D] bg-opacity-10 text-[#FF731D] rounded-xl border border-[#FF731D] font-medium text-center">
                        <p class="text-lg mb-1">Anda telah melakukan <span class="font-bold">{{ $jumlahPendaftaran }}</span> kali pendaftaran sebagai pelanggan.</p>
                        <p>Silakan lakukan pembayaran atau cek status pembayaran Anda.</p>
                    </div>
                @endif

                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {{-- Button to register as a PDAM customer --}}
                    <a href="{{ route('pendaftaran.form') }}"
                       class="flex items-center justify-center text-center bg-[#FF731D] text-white px-6 py-3 rounded-xl shadow-md hover:bg-opacity-80 transition duration-300 ease-in-out transform hover:scale-105 font-semibold">
                        <!-- Plus icon for "Daftar Pelanggan" -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Daftar Pelanggan
                    </a>

                    {{-- Button to check the latest payment status --}}
                    <a href="{{ route('pembayaran.cek') }}"
                       class="flex items-center justify-center text-center bg-[#5F9DF7] text-white px-6 py-3 rounded-xl shadow-md hover:bg-opacity-80 transition duration-300 ease-in-out transform hover:scale-105 font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Cek Status Pembayaran
                    </a>

                    {{-- Button to view payment history --}}
                    <a href="{{ route('pembayaran.riwayat') }}"
                       class="flex items-center justify-center text-center bg-[#1746A2] text-white px-6 py-3 rounded-xl shadow-md hover:bg-opacity-80 transition duration-300 ease-in-out transform hover:scale-105 font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Lihat Riwayat Pembayaran
                    </a>
                </div>

                <!-- Informasi ala-ala -->
                <div class="mt-12 pt-8 border-t border-gray-200">
                    <h3 class="text-2xl font-extrabold text-[#1746A2] mb-6 text-center">Pemberitahuan & Informasi Penting</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-start space-x-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#FF731D] flex-shrink-0 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <div>
                                <h4 class="font-bold text-lg text-[#1746A2] mb-1">Jadwal Perbaikan Jaringan Air</h4>
                                <p class="text-sm text-gray-700">Mohon diperhatikan, akan ada perbaikan jaringan air di area Banyumas Selatan pada tanggal 25-26 Juli 2025. Suplai air mungkin terganggu.</p>
                                <span class="text-xs text-gray-500 mt-2 block">20 Juni 2025</span>
                            </div>
                        </div>

                        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-start space-x-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#5F9DF7] flex-shrink-0 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16V9m2 2l-2-2-2 2m2 7l-2 2-2-2m-2-7h.01M7 16h.01M7 12h.01M7 8h.01m.01-.01L12 8l-2-2-2 2h-1a2 2 0 00-2 2v5a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H9.01z" />
                            </svg>
                            <div>
                                <h4 class="font-bold text-lg text-[#1746A2] mb-1">Informasi Kenaikan Tarif</h4>
                                <p class="text-sm text-gray-700">Terhitung mulai 1 Agustus 2025, akan ada penyesuaian tarif air bersih. Detail lengkap dapat dilihat di website kami.</p>
                                <span class="text-xs text-gray-500 mt-2 block">15 Juni 2025</span>
                            </div>
                        </div>

                         <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-start space-x-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#FF731D] flex-shrink-0 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.105A9.952 9.952 0 0112 4c4.97 0 9 3.582 9 8z" />
                            </svg>
                            <div>
                                <h4 class="font-bold text-lg text-[#1746A2] mb-1">Layanan Pelanggan 24/7</h4>
                                <p class="text-sm text-gray-700">Untuk bantuan dan pengaduan, layanan pelanggan kami siap melayani Anda 24 jam sehari, 7 hari seminggu melalui telepon atau chat.</p>
                                <span class="text-xs text-gray-500 mt-2 block">10 Juni 2025</span>
                            </div>
                        </div>
                       
                        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-start space-x-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#5F9DF7] flex-shrink-0 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M18 12a6 6 0 11-12 0 6 6 0 0112 0z" />
                            </svg>
                            <div>
                                <h4 class="font-bold text-lg text-[#1746A2] mb-1">Pembukaan Kantor Cabang Baru</h4>
                                <p class="text-sm text-gray-700">Segera dibuka kantor cabang baru di wilayah Purwokerto Barat untuk mempermudah akses layanan bagi pelanggan kami.</p>
                                <span class="text-xs text-gray-500 mt-2 block">01 Juni 2025</span>
                            </div>
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
</body>
</html>
