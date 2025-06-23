<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDAM Banyumas - Profil Pengguna</title>
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
                            <a href="{{ url('/dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition duration-150 ease-in-out">Dashboard</a>
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
        <main class="flex-grow py-5 sm:py-9">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-6">
                <div class="mb-4 text-start w-full">
                    <a href="{{ url('/dashboard') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-[#1746A2] transition duration-300 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Dashboard
                    </a>
                </div>

                <!-- Profile Information Section (was update-profile-information-form.blade.php) -->
                <div class="p-6 sm:p-8 bg-white shadow-xl rounded-3xl"> {{-- Adjusted shadow and rounded for softer look --}}
                    <div class="w-full"> {{-- Removed max-w-lg and mx-auto to make content fill the card --}}
                        <header class="mb-6">
                            <h2 class="text-2xl font-extrabold text-[#1746A2] mb-2">
                                {{ __('Informasi Profil') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Perbarui informasi profil akun dan alamat email Anda.") }}
                            </p>
                        </header>

                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                            @csrf
                        </form>

                        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')

                            <div>
                                <label for="name" class="block text-gray-700 font-medium mb-2">{{ __('Nama') }}</label>
                                <input id="name" name="name" type="text"
                                    class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-[#5F9DF7] focus:ring focus:ring-[#5F9DF7] focus:ring-opacity-50 transition duration-300 ease-in-out"
                                    value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                                @error('name')
                                    <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-gray-700 font-medium mb-2">{{ __('Email') }}</label>
                                <input id="email" name="email" type="email"
                                    class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-[#5F9DF7] focus:ring focus:ring-[#5F9DF7] focus:ring-opacity-50 transition duration-300 ease-in-out"
                                    value="{{ old('email', $user->email) }}" required autocomplete="username" />
                                @error('email')
                                    <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                                @enderror

                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-800">
                                            {{ __('Alamat email Anda belum terverifikasi.') }}

                                            <button form="send-verification" class="inline-block text-sm text-[#1746A2] hover:text-[#5F9DF7] underline transition duration-300 ease-in-out">
                                                {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                                            </button>
                                        </p>

                                        @if (session('status') === 'verification-link-sent')
                                            <p class="mt-2 font-medium text-sm text-green-600">
                                                {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                                            </p>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <div class="flex items-center gap-4 mt-6">
                                <button type="submit" class="bg-[#FF731D] hover:bg-opacity-70 text-white font-bold px-6 py-3 rounded-xl shadow-md transition duration-500 ease-in-out transform hover:scale-100">
                                    {{ __('Simpan') }}
                                </button>

                                @if (session('status') === 'profile-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600"
                                    >{{ __('Disimpan.') }}</p>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Update Password Section (was update-password-form.blade.php) -->
                <div class="p-6 sm:p-8 bg-white shadow-xl rounded-3xl"> {{-- Adjusted shadow and rounded for softer look --}}
                    <div class="w-full"> {{-- Removed max-w-lg and mx-auto to make content fill the card --}}
                        <header class="mb-6">
                            <h2 class="text-2xl font-extrabold text-[#1746A2] mb-2">
                                {{ __('Perbarui Password') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')

                            <div>
                                <label for="update_password_current_password" class="block text-gray-700 font-medium mb-2">{{ __('Password Saat Ini') }}</label>
                                <input id="update_password_current_password" name="current_password" type="password"
                                    class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-[#5F9DF7] focus:ring focus:ring-[#5F9DF7] focus:ring-opacity-50 transition duration-300 ease-in-out"
                                    autocomplete="current-password" />
                                @error('current_password', 'updatePassword') {{-- Specify error bag --}}
                                    <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="update_password_password" class="block text-gray-700 font-medium mb-2">{{ __('Password Baru') }}</label>
                                <input id="update_password_password" name="password" type="password"
                                    class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-[#5F9DF7] focus:ring focus:ring-[#5F9DF7] focus:ring-opacity-50 transition duration-300 ease-in-out"
                                    autocomplete="new-password" />
                                @error('password', 'updatePassword') {{-- Specify error bag --}}
                                    <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="update_password_password_confirmation" class="block text-gray-700 font-medium mb-2">{{ __('Konfirmasi Password') }}</label>
                                <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                                    class="block w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-[#5F9DF7] focus:ring focus:ring-[#5F9DF7] focus:ring-opacity-50 transition duration-300 ease-in-out"
                                    autocomplete="new-password" />
                                @error('password_confirmation', 'updatePassword') {{-- Specify error bag --}}
                                    <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center gap-4 mt-6">
                                <button type="submit" class="bg-[#FF731D] hover:bg-opacity-70 text-white font-bold px-6 py-3 rounded-xl shadow-md transition duration-500 ease-in-out transform hover:scale-100">
                                    {{ __('Simpan') }}
                                </button>

                                @if (session('status') === 'password-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600"
                                    >{{ __('Disimpan.') }}</p>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Delete User Section (was delete-user-form.blade.php) -->
                <div x-data="{ openModal: {{ $errors->userDeletion->isNotEmpty() ? 'true' : 'false' }} }" class="p-6 sm:p-8 bg-white shadow-xl rounded-3xl"> {{-- Adjusted shadow and rounded for softer look --}}
                    <div class="w-full"> {{-- Removed max-w-lg and mx-auto to make content fill the card --}}
                        <header class="mb-6">
                            <h2 class="text-2xl font-extrabold text-[#1746A2] mb-2">
                                {{ __('Hapus Akun') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.') }}
                            </p>
                        </header>

                        <button @click="openModal = true" type="button" class="bg-red-600 hover:bg-red-700 text-white font-bold px-6 py-3 rounded-xl shadow-md transition duration-500 ease-in-out transform hover:scale-100">
                            {{ __('Hapus Akun') }}
                        </button>

                        <!-- Modal Confirmation for Delete Account -->
                        <div x-show="openModal" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                             class="fixed inset-0 z-50 flex items-center justify-center p-4" style="display: none;">
                            <!-- Overlay -->
                            <div class="fixed inset-0 bg-gray-900 bg-opacity-75" @click="openModal = false"></div>

                            <!-- Modal Content -->
                            <div class="relative bg-white rounded-3xl shadow-xl p-6 sm:p-8 w-full max-w-md mx-auto z-50">
                                <form method="post" action="{{ route('profile.destroy') }}" class="p-2">
                                    @csrf
                                    @method('delete')

                                    <h2 class="text-xl font-extrabold text-[#1746A2] mb-4">
                                        {{ __('Apakah Anda yakin ingin menghapus akun Anda?') }}
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ __('Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Harap masukkan password Anda untuk mengkonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.') }}
                                    </p>

                                    <div class="mt-6">
                                        <label for="password_delete" class="sr-only">{{ __('Password') }}</label>
                                        <input
                                            id="password_delete" {{-- Changed ID to avoid conflict if other forms have 'password' ID --}}
                                            name="password"
                                            type="password"
                                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-[#5F9DF7] focus:ring focus:ring-[#5F9DF7] focus:ring-opacity-50 transition duration-300 ease-in-out"
                                            placeholder="{{ __('Password') }}"
                                        />
                                        @error('password', 'userDeletion') {{-- Specify error bag --}}
                                            <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-6 flex justify-end gap-3">
                                        <button type="button" @click="openModal = false" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold px-5 py-2 rounded-lg transition duration-300 ease-in-out">
                                            {{ __('Batal') }}
                                        </button>

                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold px-5 py-2 rounded-lg transition duration-300 ease-in-out">
                                            {{ __('Hapus Akun') }}
                                        </button>
                                    </div>
                                </form>
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
