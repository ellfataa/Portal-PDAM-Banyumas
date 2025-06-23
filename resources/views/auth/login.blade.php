<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDAM Banyumas - Masuk</title>
    <!-- Vite untuk Tailwind CSS and JavaScript -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FFFFFF] text-gray-800 antialiased font-sans">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full md:max-w-xl mt-6 px-8 py-10 bg-white shadow-xl overflow-hidden sm:rounded-3xl border border-gray-100">
            <h2 class="text-3xl font-extrabold text-center text-[#1746A2] mb-4">Selamat Datang Kembali!</h2>

            <div class="mt-2 mb-6 text-start">
                <a href="{{ url('/') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-[#1746A2] transition duration-300 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>

            <!-- Flash Message Setelah Registrasi -->
            @if (session('success'))
                <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-700 font-semibold border border-green-200">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-5">
                    <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                    <input
                        id="email"
                        class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-[#5F9DF7] focus:ring focus:ring-[#5F9DF7] focus:ring-opacity-50 transition duration-300 ease-in-out"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    @error('email')
                        <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-5">
                    <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                    <input
                        id="password"
                        class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-[#5F9DF7] focus:ring focus:ring-[#5F9DF7] focus:ring-opacity-50 transition duration-300 ease-in-out"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                    />
                    @error('password')
                        <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex justify-between items-center mb-6">
                    <label for="remember_me" class="inline-flex items-center">
                        <input
                            id="remember_me"
                            type="checkbox"
                            class="rounded border-gray-300 text-[#5F9DF7] shadow-sm focus:ring-[#5F9DF7] transition duration-300 ease-in-out"
                            name="remember"
                        >
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a
                            class="text-sm text-[#1746A2] hover:text-[#5F9DF7] underline transition duration-300 ease-in-out"
                            href="{{ route('password.request') }}"
                        >
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <button type="submit" class="w-full flex justify-center items-center bg-[#FF731D] hover:bg-opacity-70 text-white font-bold py-3 rounded-xl shadow-md transition duration-500 ease-in-out transform hover:scale-100">
                    {{ __('Log in') }}
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-[#5F9DF7] hover:text-[#1746A2] font-semibold underline transition duration-300 ease-in-out">Daftar Sekarang</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
