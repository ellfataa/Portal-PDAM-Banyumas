<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-[#1746A2] leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-gradient-to-r from-[#1746A2] to-[#5F9DF7] overflow-hidden shadow-lg rounded-2xl mb-8 transform transition duration-500 hover:scale-[1.01]">
                <div class="p-8 flex items-center justify-between">
                    <div class="text-white">
                        <h3 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h3>
                        <p class="text-blue-100 text-lg">Anda berhasil masuk ke sistem Portal Layanan PDAM Banyumas.</p>
                    </div>
                    <!-- Ikon ilustrasi dekoratif -->
                    <div class="hidden md:block bg-white/20 p-4 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Konten Utama: Informasi Akun -->
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100">
                <div class="p-8 text-gray-900">
                    <div class="flex items-center mb-6 border-b border-gray-100 pb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#FF731D] mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h4 class="text-xl font-bold text-gray-800">Informasi Akun</h4>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="bg-gray-50 p-5 rounded-xl border border-gray-100">
                            <p class="text-sm text-gray-500 font-semibold mb-1">Nama Lengkap</p>
                            <p class="font-bold text-lg text-[#1746A2]">{{ Auth::user()->name }}</p>
                        </div>
                        <div class="bg-gray-50 p-5 rounded-xl border border-gray-100">
                            <p class="text-sm text-gray-500 font-semibold mb-1">Alamat Email</p>
                            <p class="font-bold text-lg text-[#1746A2]">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="bg-gray-50 p-5 rounded-xl border border-gray-100">
                            <p class="text-sm text-gray-500 font-semibold mb-1">Hak Akses (Role)</p>
                            <p class="font-bold text-lg text-white bg-[#FF731D] inline-block px-4 py-1 rounded-full capitalize mt-1 shadow-sm">
                                {{ Auth::user()->role }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Login Berhasil!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                    backdrop: `
                        rgba(0,0,123,0.1)
                        left top
                        no-repeat
                    `
                });
            @endif
        });
    </script>
</x-app-layout>
