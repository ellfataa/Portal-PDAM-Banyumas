<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDAM Banyumas - Profil Pengguna</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased min-w-[1024px]">
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
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 font-medium hover:bg-blue-50 hover:text-[#1746A2] transition duration-150">Dashboard</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 font-medium hover:bg-red-50 transition duration-150">Keluar</button>
                            </form>
                        </div>
                    </div>
                </nav>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow py-10 px-12">
            <div class="max-w-7xl mx-auto space-y-8">

                <div class="mb-4 text-start w-full">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-semibold text-gray-500 hover:text-[#1746A2] transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Dashboard
                    </a>
                </div>

                <!-- Memanggil File Partials -->
                <div class="p-8 bg-white shadow-sm border border-gray-100 rounded-[2rem]">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="p-8 bg-white shadow-sm border border-gray-100 rounded-[2rem]">
                    @include('profile.partials.update-password-form')
                </div>

                <div class="p-8 bg-white shadow-sm border border-gray-100 rounded-[2rem]">
                    @include('profile.partials.delete-user-form')
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
</body>
</html>
