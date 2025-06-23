<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDAM Banyumas</title>
    <!-- Vite untuk Tailwind CSS and JavaScript -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800 antialiased font-sans">
    <div class="min-h-screen flex flex-col">

        <header class="bg-white text-gray-800 shadow-lg py-4 px-6 md:px-8">
            <div class="max-w-7xl mx-auto flex flex-wrap justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center space-x-3 sm:space-x-4 mb-2 md:mb-0">
                    <img src="{{ asset('images/logo-pdam.png') }}" alt="Logo PDAM Banyumas" class="h-10 w-25 sm:h-12 sm:w-27">
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-[#1746A2]">PDAM Banyumas</h1>
                </div>

                <!-- Navigasi Links -->
                <nav class="w-full md:w-auto flex justify-center md:justify-end items-center space-x-4 sm:space-x-6 text-base font-medium">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-[#FF731D] hover:bg-opacity-70 text-white font-bold px-5 py-2 rounded-lg transition duration-500 ease-in-out shadow-md">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-[#1746A2] hover:text-[#5F9DF7] px-3 py-2 rounded-lg transition duration-500 ease-in-out">Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-[#5F9DF7] hover:bg-opacity-70 text-white font-bold px-5 py-2 rounded-lg transition duration-500 ease-in-out shadow-md">Daftar</a>
                            @endif
                        @endauth
                    @endif
                </nav>
            </div>
        </header>

        <!-- Hero Section -->
        <main class="flex-grow bg-white px-6 py-3 md:py-6 flex items-center justify-center">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-center gap-12 md:gap-16">
                
                <!-- Text Content -->
                <div class="md:w-7/12 text-center md:text-left animate-fade-in-up">
                    <h2 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-[#1746A2] mb-6 leading-tight">
                        Selamat Datang di Portal
                        <br class="hidden sm:inline-block"> <span class="text-[#FF731D]">PDAM Banyumas</span>
                    </h2>
                    <p class="text-lg sm:text-xl text-gray-700 mb-8 max-w-lg md:max-w-none mx-auto">
                        PDAM Banyumas hadir memberikan pelayanan air bersih terbaik untuk seluruh masyarakat. Cek tagihan, riwayat, dan informasi terbaru melalui sistem online kami.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center md:justify-start gap-5">
                        <a href="{{ route('login') }}" class="bg-[#FF731D] hover:bg-opacity-70 text-white px-7 py-3 rounded-lg font-semibold shadow-md transition duration-500 ease-in-out transform hover:scale-105">
                            Masuk Sekarang
                        </a>
                        <a href="{{ route('register') }}" class="bg-white text-[#1746A2] border-2 border-[#1746A2] hover:bg-[#1746A2] hover:text-white px-7 py-3 rounded-lg font-semibold shadow-md transition duration-500 ease-in-out transform hover:scale-105">
                            Daftar Akun
                        </a>
                    </div>
                </div>

                <!-- Illustrasi -->
                <div class="md:w-5/12 flex justify-center animate-fade-in-right">
                    <img src="{{ asset('images/water-splash.png') }}" alt="Ilustrasi Air Bersih" class="w-full max-w-sm sm:max-w-md lg:max-w-lg rounded-3xl object-cover">
                </div>
            </div>
        </main>

        <!-- Informasi ala-ala -->
        <section class="bg-white py-4 md:py-10">
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-10 px-6 text-center">
                <!-- Card 1: Online Payment -->
                <div class="flex flex-col items-center p-6 rounded-3xl shadow-md hover:shadow-lg transition duration-500 ease-in-out transform hover:-translate-y-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-[#5F9DF7] mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 15a4 4 0 004 4h10a4 4 0 004-4m-4-6v2a2 2 0 002 2h2M6 9v2a2 2 0 01-2 2H2" />
                    </svg>
                    <h3 class="font-bold text-xl text-gray-900 mb-2">Pembayaran Online</h3>
                    <p class="text-base text-gray-700 leading-relaxed">
                        Bayar tagihan air dengan mudah melalui sistem online kami kapan saja, di mana saja.
                    </p>
                </div>

                <!-- Card 2: Billing History -->
                <div class="flex flex-col items-center p-6 rounded-3xl shadow-md hover:shadow-lg transition duration-500 ease-in-out transform hover:-translate-y-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-[#FF731D] mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 16h8M8 12h8m-7 8h6a2 2 0 002-2V6a2 2 0 00-2-2H9a2 2 0 00-2 2v14l3-3z" />
                    </svg>
                    <h3 class="font-bold text-xl text-gray-900 mb-2">Riwayat Tagihan</h3>
                    <p class="text-base text-gray-700 leading-relaxed">
                        Pantau riwayat pembayaran Anda secara transparan dan terstruktur.
                    </p>
                </div>

                <!-- Card 3: Information Services -->
                <div class="flex flex-col items-center p-6 rounded-3xl shadow-md hover:shadow-lg transition duration-500 ease-in-out transform hover:-translate-y-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-[#1746A2] mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c0 .548.224 1.042.586 1.414A2 2 0 0014 13m0 0a2 2 0 01-2 2m0 0a2 2 0 01-2-2m0 0a2 2 0 002-2m0 0V9m0 0a2 2 0 00-2-2m0 0a2 2 0 012-2m0 0a2 2 0 012 2m0 0a2 2 0 00-2 2" />
                    </svg>
                    <h3 class="font-bold text-xl text-gray-900 mb-2">Layanan Informasi</h3>
                    <p class="text-base text-gray-700 leading-relaxed">
                        Dapatkan pengumuman dan info terkini seputar layanan PDAM secara berkala.
                    </p>
                </div>
            </div>
        </section>

        <footer class="bg-[#1746A2] text-white text-center py-5 text-sm font-light">
            <div class="max-w-7xl mx-auto px-6">
                &copy; {{ date('Y') }} PDAM Banyumas. Seluruh hak cipta dilindungi.
            </div>
        </footer>
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 1s ease-out forwards;
        }
        .animate-fade-in-right {
            animation: fadeInRight 1s ease-out forwards;
        }
        /* Ensure font is 'Inter' or a suitable sans-serif */
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</body>
</html>
