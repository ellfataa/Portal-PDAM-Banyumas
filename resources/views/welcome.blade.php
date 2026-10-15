<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDAM Banyumas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 antialiased font-sans min-w-[1024px]">
    <div class="min-h-screen flex flex-col">

        <!-- Header -->
        <header class="bg-white shadow-sm py-3 px-12 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <!-- Logo and Title -->
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('images/logo-pdam.png') }}" alt="Logo PDAM Banyumas" class="h-10 w-auto">
                    <h1 class="text-2xl font-extrabold tracking-tight text-[#1746A2]">PDAM Banyumas</h1>
                </div>

                <!-- Navigation Links -->
                <nav class="flex items-center space-x-6 text-base font-semibold">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('dashboard') }}" class="bg-[#FF731D] hover:bg-[#e06518] text-white px-6 py-2 rounded-xl transition duration-300 shadow-md">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-[#1746A2] hover:text-[#5F9DF7] px-4 py-2 transition duration-300">Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-[#5F9DF7] hover:bg-[#4a84d4] text-white px-6 py-2 rounded-xl transition duration-300 shadow-md">Daftar</a>
                            @endif
                        @endauth
                    @endif
                </nav>
            </div>
        </header>

        <!-- Hero Section -->
        <main class="flex-grow bg-gradient-to-br from-blue-50 via-white to-orange-50 flex items-center justify-center py-10 px-12 pb-32">
            <div class="max-w-7xl mx-auto flex items-center justify-between gap-16">

                <!-- Text Content -->
                <div class="w-1/2 animate-fade-in-up">
                    <span class="text-[#FF731D] font-bold tracking-wider uppercase text-sm mb-4 block">Portal Layanan Pelanggan</span>
                    <h2 class="text-6xl font-extrabold text-[#1746A2] mb-6 leading-[1.2]">
                        Kemudahan Akses Air Bersih dalam <br>
                        <span class="text-[#FF731D]">Satu Genggaman</span>
                    </h2>
                    <p class="text-xl text-gray-600 mb-10 leading-relaxed">
                        Nikmati kemudahan layanan PDAM Banyumas. Bayar tagihan, cek riwayat pemakaian, dan dapatkan informasi terbaru langsung dari perangkat Anda tanpa perlu antre.
                    </p>
                    <div class="flex items-center gap-6">
                        <a href="{{ route('login') }}" class="bg-[#FF731D] hover:bg-[#e06518] text-white px-8 py-4 rounded-xl font-bold text-lg shadow-lg shadow-orange-200 transition duration-300 transform hover:-translate-y-1">
                            Masuk Sekarang
                        </a>
                        <a href="{{ route('register') }}" class="bg-white text-[#1746A2] border-2 border-[#1746A2] hover:bg-[#1746A2] hover:text-white px-8 py-4 rounded-xl font-bold text-lg shadow-lg transition duration-300 transform hover:-translate-y-1">
                            Daftar Akun
                        </a>
                    </div>
                </div>

                <!-- Illustration -->
                <div class="w-1/2 flex justify-end animate-fade-in-right">
                    <img src="{{ asset('images/water-splash.png') }}" alt="Ilustrasi Air Bersih" class="w-[400px] h-auto">
                </div>
            </div>
        </main>

        <!-- Short Information Section -->
        <section class="bg-white py-20 px-12 relative z-10 -mt-20 rounded-t-[3rem] shadow-[0_-10px_40px_rgba(0,0,0,0.05)]">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-extrabold text-[#1746A2]">Layanan Unggulan Kami</h2>
                    <p class="text-gray-500 mt-4 text-lg">Hadir untuk memberikan kenyamanan dan transparansi bagi pelanggan.</p>
                </div>

                <div class="grid grid-cols-3 gap-12 text-center">
                    <!-- Card 1 -->
                    <div class="bg-gray-50 p-10 rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl hover:border-blue-100 transition duration-300 transform hover:-translate-y-2 group">
                        <div class="bg-blue-100 w-24 h-24 mx-auto rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#5F9DF7]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 15a4 4 0 004 4h10a4 4 0 004-4m-4-6v2a2 2 0 002 2h2M6 9v2a2 2 0 01-2 2H2" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-2xl text-[#1746A2] mb-4">Pembayaran Online</h3>
                        <p class="text-gray-600 text-lg leading-relaxed">
                            Bayar tagihan air Anda dengan mudah, cepat, dan aman melalui sistem integrasi lokal kapan saja.
                        </p>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-gray-50 p-10 rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl hover:border-orange-100 transition duration-300 transform hover:-translate-y-2 group">
                        <div class="bg-orange-100 w-24 h-24 mx-auto rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#FF731D]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 16h8M8 12h8m-7 8h6a2 2 0 002-2V6a2 2 0 00-2-2H9a2 2 0 00-2 2v14l3-3z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-2xl text-[#1746A2] mb-4">Riwayat Tagihan</h3>
                        <p class="text-gray-600 text-lg leading-relaxed">
                            Pantau dan kelola riwayat pembayaran Anda secara transparan, terstruktur, dan akurat.
                        </p>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-gray-50 p-10 rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl hover:border-blue-100 transition duration-300 transform hover:-translate-y-2 group">
                        <div class="bg-blue-100 w-24 h-24 mx-auto rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#1746A2]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c0 .548.224 1.042.586 1.414A2 2 0 0014 13m0 0a2 2 0 01-2 2m0 0a2 2 0 01-2-2m0 0a2 2 0 002-2m0 0V9m0 0a2 2 0 00-2-2m0 0a2 2 0 012-2m0 0a2 2 0 012 2m0 0a2 2 0 00-2 2" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-2xl text-[#1746A2] mb-4">Layanan Informasi</h3>
                        <p class="text-gray-600 text-lg leading-relaxed">
                            Dapatkan pengumuman dan info terkini seputar layanan air bersih di wilayah Anda dengan cepat.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer Section -->
        <footer class="bg-[#1746A2] text-white text-center py-6 text-base font-light">
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
            animation: fadeInUp 1s ease-out forwards;
        }
        .animate-fade-in-right {
            animation: fadeInRight 1s ease-out forwards;
        }
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Sampai Jumpa!',
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
