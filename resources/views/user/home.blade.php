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

        <!-- Header Section (Navbar for Authenticated User) -->
        <header class="bg-white text-gray-800 shadow-lg py-4 px-6 md:px-8">
            <div class="max-w-7xl mx-auto flex flex-wrap justify-between items-center">
                <!-- Logo and Title -->
                <div class="flex items-center space-x-3 sm:space-x-4 mb-2 md:mb-0">
                    <img src="{{ asset('images/logo-pdam.png') }}" alt="Logo PDAM Banyumas" class="h-10 w-25 sm:h-12 sm:w-27">
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-[#1746A2]">PDAM Banyumas</h1>
                </div>

                <!-- User Info & Logout (Dropdown Menu) -->
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

        <!-- Main content area -->
        <main class="flex-grow py-12 sm:py-16">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <p class="text-gray-700 mb-6 text-lg">
                    Selamat datang, {{ Auth::user()->name }}! Berikut adalah layanan yang tersedia untuk Anda:
                </p>

                @php
                    $user = Auth::user();
                    $jumlahPendaftaran = $user->pendaftarans()->count();
                @endphp

                @if($jumlahPendaftaran === 0)
                    <div class="mb-6 p-4 sm:p-5 bg-[#5F9DF7] bg-opacity-10 text-[#1746A2] rounded-xl border border-[#5F9DF7] font-medium text-center">
                        <p class="text-lg mb-1">Anda belum mendaftar sebagai pelanggan.</p>
                        <p>Silakan isi formulir pendaftaran pelanggan untuk dapat melanjutkan ke proses pembayaran.</p>
                    </div>
                @else
                    <div class="mb-6 p-4 sm:p-5 bg-[#FF731D] bg-opacity-10 text-[#FF731D] rounded-xl border border-[#FF731D] font-medium text-center">
                        <p class="text-lg mb-1">Anda telah melakukan <span class="font-bold">{{ $jumlahPendaftaran }}</span> kali pendaftaran sebagai pelanggan.</p>
                        <p>Silakan lakukan pembayaran atau cek status pembayaran Anda.</p>
                    </div>
                @endif

                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <a href="{{ route('pendaftaran.form') }}" class="flex items-center justify-center text-center bg-[#FF731D] text-white px-6 py-3 rounded-xl shadow-md hover:bg-opacity-80 transition duration-300 ease-in-out transform hover:scale-105 font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Daftar Pelanggan
                    </a>
                    <a href="{{ route('pembayaran.cek') }}" class="flex items-center justify-center text-center bg-[#5F9DF7] text-white px-6 py-3 rounded-xl shadow-md hover:bg-opacity-80 transition duration-300 ease-in-out transform hover:scale-105 font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Cek Status Pembayaran
                    </a>
                    <a href="{{ route('pembayaran.riwayat') }}" class="flex items-center justify-center text-center bg-[#1746A2] text-white px-6 py-3 rounded-xl shadow-md hover:bg-opacity-80 transition duration-300 ease-in-out transform hover:scale-105 font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477-4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Lihat Riwayat Pembayaran
                    </a>
                </div>

                <!-- General Announcements Section (Tetap sama) -->
                <!-- ... Konten Pengumuman ... -->
            </div>
        </main>

        <footer class="bg-[#1746A2] text-white text-center py-5 text-sm font-light">
            <div class="max-w-7xl mx-auto px-6">
                &copy; {{ date('Y') }} PDAM Banyumas. Seluruh hak cipta dilindungi.
            </div>
        </footer>
    </div>

    <!-- Tambahan Script SweetAlert2 untuk Menangkap Pop-up Login -->
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
