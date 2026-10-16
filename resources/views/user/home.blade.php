<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDAM Banyumas - Dashboard Pengguna</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 antialiased font-sans min-w-[1024px]">
    <div class="min-h-screen flex flex-col">

        <header class="bg-white shadow-sm py-3 px-12 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <!-- Logo and Title -->
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('images/logo-pdam.png') }}" alt="Logo PDAM Banyumas" class="h-10 w-auto">
                    <h1 class="text-2xl font-extrabold tracking-tight text-[#1746A2]">PDAM Banyumas</h1>
                </div>

                <!-- User Info & Logout (Dropdown Menu) -->
                <nav class="flex items-center space-x-6 text-base font-semibold">
                    <div x-data="{ open: false }" @click.away="open = false" class="relative">
                        <button @click="open = !open" class="flex items-center space-x-2 text-[#1746A2] hover:text-[#5F9DF7] px-4 py-2 transition duration-300 focus:outline-none">
                            <span>Halo, {{ Auth::user()->name }}</span>
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
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

        <!-- Main content area -->
        <main class="flex-grow py-12 px-12">
            <div class="max-w-7xl mx-auto">

                <div class="mb-10 animate-fade-in-up">
                    <span class="text-[#FF731D] font-bold tracking-wider uppercase text-sm mb-2 block">Dashboard Pelanggan</span>
                    <h2 class="text-4xl font-extrabold text-[#1746A2] mb-4">
                        Selamat datang, {{ Auth::user()->name }}!
                    </h2>
                    <p class="text-xl text-gray-600">Berikut adalah layanan yang tersedia untuk Anda kelola hari ini.</p>
                </div>

                @php
                    $user = Auth::user();
                    $jumlahPendaftaran = $user->pendaftarans()->count();
                @endphp

                <!-- Notifikasi Status -->
                @if($jumlahPendaftaran === 0)
                    <div class="mb-12 p-8 bg-gradient-to-r from-blue-50 to-white text-[#1746A2] rounded-[2rem] border border-blue-100 shadow-sm flex items-center gap-6 animate-fade-in-right">
                        <div class="bg-white p-4 rounded-full shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#5F9DF7]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-1">Anda belum mendaftar sebagai pelanggan</h3>
                            <p class="text-gray-600 text-lg">Silakan isi formulir pendaftaran pelanggan untuk dapat melanjutkan ke proses pembayaran.</p>
                        </div>
                    </div>
                @else
                    <div class="mb-12 p-8 bg-gradient-to-r from-orange-50 to-white text-[#FF731D] rounded-[2rem] border border-orange-100 shadow-sm flex items-center gap-6 animate-fade-in-right">
                        <div class="bg-white p-4 rounded-full shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#FF731D]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-1">Pendaftaran Ditemukan</h3>
                            <p class="text-gray-600 text-lg">Anda telah melakukan pendaftaran sebanyak <span class="font-extrabold text-[#1746A2]">{{ $jumlahPendaftaran }} kali</span>. Anda dapat melanjutkan ke proses pembayaran.</p>
                        </div>
                    </div>
                @endif

                <div class="grid grid-cols-3 gap-12 text-center mb-16 animate-fade-in-up" style="animation-delay: 0.2s;">

                    <!-- Card 1: Pendaftaran -->
                    <a href="{{ route('pendaftaran.form') }}" class="block bg-white p-10 rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl hover:border-orange-100 transition duration-300 transform hover:-translate-y-2 group">
                        <div class="bg-orange-100 w-24 h-24 mx-auto rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#FF731D]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-2xl text-[#1746A2] mb-3">Daftar Pelanggan</h3>
                        <p class="text-gray-500 text-lg leading-relaxed">
                            Mulai berlangganan air bersih atau tambahkan titik pemasangan baru.
                        </p>
                    </a>

                    <!-- Card 2: Cek Pembayaran -->
                    <a href="{{ route('pembayaran.cek') }}" class="block bg-white p-10 rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl hover:border-blue-100 transition duration-300 transform hover:-translate-y-2 group">
                        <div class="bg-blue-100 w-24 h-24 mx-auto rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#5F9DF7]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-2xl text-[#1746A2] mb-3">Status Tagihan</h3>
                        <p class="text-gray-500 text-lg leading-relaxed">
                            Periksa tagihan berjalan dan lakukan pembayaran online sekarang juga.
                        </p>
                    </a>

                    <!-- Card 3: Riwayat -->
                    <a href="{{ route('pembayaran.riwayat') }}" class="block bg-white p-10 rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl hover:border-blue-100 transition duration-300 transform hover:-translate-y-2 group">
                        <div class="bg-[#1746A2] bg-opacity-10 w-24 h-24 mx-auto rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#1746A2]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477-4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-2xl text-[#1746A2] mb-3">Riwayat Transaksi</h3>
                        <p class="text-gray-500 text-lg leading-relaxed">
                            Lihat dan unduh bukti seluruh riwayat pembayaran Anda sebelumnya.
                        </p>
                    </a>
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

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap');

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        .animate-fade-in-right {
            animation: fadeInRight 0.8s ease-out forwards;
        }
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>

    <!-- Script SweetAlert2 Pop-up Login -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true
                });
            @endif
        });
    </script>
</body>
</html>
