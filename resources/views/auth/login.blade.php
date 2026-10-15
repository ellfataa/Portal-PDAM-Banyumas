<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDAM Banyumas - Masuk</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 antialiased font-sans min-w-[1024px]">

    <div class="min-h-screen flex flex-col justify-center items-center bg-[url('/public/images/backgroundPDAM.jpg')] bg-cover bg-center py-6">

        <div class="w-[500px] px-10 py-8 bg-white shadow-[0_10px_40px_rgba(0,0,0,0.08)] rounded-[2rem] border border-gray-100 backdrop-blur-sm bg-white/95">

            <h2 class="text-3xl font-extrabold text-center text-[#1746A2] mb-6">Selamat Datang Kembali!</h2>

            <div class="mb-4 text-left">
                <a href="{{ route('welcome') }}" class="inline-flex items-center text-sm font-semibold text-gray-400 hover:text-[#1746A2] transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Halaman Utama
                </a>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm text-gray-700 font-semibold mb-1">Email</label>
                    <input id="email" class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:border-[#5F9DF7] focus:bg-white focus:ring focus:ring-[#5F9DF7] focus:ring-opacity-20 transition duration-300" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm text-gray-700 font-semibold mb-1">Password</label>
                    <input id="password" class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:border-[#5F9DF7] focus:bg-white focus:ring focus:ring-[#5F9DF7] focus:ring-opacity-20 transition duration-300" type="password" name="password" required autocomplete="current-password" />
                </div>

                <button type="submit" class="w-full flex justify-center items-center bg-[#FF731D] hover:bg-[#e06518] text-white font-bold py-3 rounded-xl shadow-lg shadow-orange-200 transition duration-300 transform hover:-translate-y-0.5">
                    Masuk Sekarang
                </button>
            </form>

            <div class="mt-6 text-center pt-4 border-t border-gray-100">
                <p class="text-sm text-gray-500 font-medium">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-[#5F9DF7] hover:text-[#1746A2] font-bold transition duration-300">Daftar di sini</a>
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Menangkap pesan error login
            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Masuk',
                    text: 'Email atau password yang Anda masukkan salah.',
                    confirmButtonColor: '#FF731D'
                });
            @endif

            // Jika ada pesan sukses (Dari halaman register)
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#1746A2'
                });
            @endif
        });
    </script>
</body>
</html>
