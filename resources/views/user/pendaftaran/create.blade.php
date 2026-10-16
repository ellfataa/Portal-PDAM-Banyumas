<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDAM Banyumas - Pendaftaran Pelanggan Baru</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 antialiased font-sans min-w-[1024px]">
    <div class="min-h-screen flex flex-col">

        <!-- Header Section -->
        <header class="bg-white shadow-sm py-3 px-12 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <!-- Logo and Title -->
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('images/logo-pdam.png') }}" alt="Logo PDAM Banyumas" class="h-10 w-auto">
                    <h1 class="text-2xl font-extrabold tracking-tight text-[#1746A2]">PDAM Banyumas</h1>
                </div>

                <!-- User Info & Logout -->
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

        <!-- Main Content -->
        <main class="flex-grow py-12 px-12">
            <div class="max-w-7xl mx-auto space-y-8 animate-fade-in-up">

                <!-- Breadcrumb -->
                <div class="mb-4">
                    <a href="{{ route('user.home') }}" class="inline-flex items-center text-sm font-semibold text-gray-500 hover:text-[#1746A2] transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Dashboard
                    </a>
                </div>

                <!-- Formulir Pendaftaran Card -->
                <div class="p-10 bg-white shadow-xl border border-gray-100 rounded-[2rem]">
                    <header class="mb-8 border-b border-gray-100 pb-6">
                        <h2 class="text-3xl font-extrabold text-[#1746A2] mb-2">
                            Pendaftaran Sambungan Baru
                        </h2>
                        <p class="text-lg text-gray-500 font-medium">
                            Lengkapi data diri, lokasi, dan unggah dokumen untuk mengajukan sambungan air PDAM.
                        </p>
                    </header>

                    @if ($errors->any())
                        <div class="mb-8 p-6 bg-red-50 rounded-2xl border border-red-200 animate-fade-in-up">
                            <div class="flex items-center mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <h3 class="font-bold text-red-800 text-lg">Gagal Menyimpan Data</h3>
                            </div>
                            <ul class="list-disc list-inside text-sm text-red-700 space-y-1 ml-2 font-medium">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('pendaftaran.store') }}" enctype="multipart/form-data" class="space-y-8">
                        @csrf

                        <div class="grid grid-cols-2 gap-8">
                            <!-- Kolom Kiri: Data Pribadi & Lokasi -->
                            <div class="space-y-6">
                                <div>
                                    <label for="nama_lengkap" class="block text-sm text-gray-700 font-semibold mb-1">Nama Lengkap</label>
                                    <input id="nama_lengkap" name="nama_lengkap" type="text" value="{{ auth()->user()->name }}" readonly required class="block w-full px-4 py-2.5 bg-gray-200 border border-gray-300 text-gray-600 rounded-xl cursor-not-allowed focus:outline-none">
                                </div>

                                <div>
                                    <label for="pekerjaan" class="block text-sm text-gray-700 font-semibold mb-1">Pekerjaan</label>
                                    <input id="pekerjaan" name="pekerjaan" type="text" value="{{ old('pekerjaan') }}" required maxlength="255" class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:border-[#5F9DF7] focus:bg-white focus:ring focus:ring-[#5F9DF7] focus:ring-opacity-20 transition duration-300" placeholder="Contoh: Wiraswasta, Pegawai Negeri">
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="kecamatan_id" class="block text-sm text-gray-700 font-semibold mb-1">Kecamatan</label>
                                        <select id="kecamatan_id" name="kecamatan_id" required class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:border-[#5F9DF7] focus:bg-white focus:ring focus:ring-[#5F9DF7] focus:ring-opacity-20 transition duration-300 cursor-pointer">
                                            <option value="" disabled selected>Pilih Kecamatan</option>
                                            @foreach ($kecamatans as $kecamatan)
                                                <option value="{{ $kecamatan->id }}" @selected(old('kecamatan_id') == $kecamatan->id)>{{$kecamatan->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="kelurahan_id" class="block text-sm text-gray-700 font-semibold mb-1">Kelurahan</label>
                                        <select id="kelurahan_id" name="kelurahan_id" required class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:border-[#5F9DF7] focus:bg-white focus:ring focus:ring-[#5F9DF7] focus:ring-opacity-20 transition duration-300 cursor-pointer" data-selected="{{ old('kelurahan_id') }}">
                                            <option value="" disabled selected>Pilih Kec. Terlebih Dahulu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Kolom Kanan: Peta, Koordinat & Upload -->
                            <div class="space-y-6">

                                <div class="p-5 bg-blue-50 border border-blue-100 rounded-2xl">
                                    <h4 class="font-bold text-[#1746A2] mb-3 text-sm flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-[#5F9DF7]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        Titik Koordinat Lokasi
                                    </h4>
                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label for="latitude" class="block text-xs text-gray-600 font-semibold mb-1">Latitude</label>
                                            <input id="latitude" name="latitude" type="number" step="any" value="{{ old('latitude') }}" required class="block w-full px-3 py-2 bg-white border border-blue-200 rounded-lg text-sm focus:border-[#5F9DF7] focus:ring focus:ring-[#5F9DF7] focus:ring-opacity-20 transition duration-300" placeholder="-7.xxx">
                                        </div>
                                        <div>
                                            <label for="longitude" class="block text-xs text-gray-600 font-semibold mb-1">Longitude</label>
                                            <input id="longitude" name="longitude" type="number" step="any" value="{{ old('longitude') }}" required class="block w-full px-3 py-2 bg-white border border-blue-200 rounded-lg text-sm focus:border-[#5F9DF7] focus:ring focus:ring-[#5F9DF7] focus:ring-opacity-20 transition duration-300" placeholder="109.xxx">
                                        </div>
                                    </div>
                                    <button id="location-button" type="button" class="w-full bg-white border-2 border-[#1746A2] text-[#1746A2] hover:bg-[#1746A2] hover:text-white font-bold py-2 rounded-xl transition duration-300 flex items-center justify-center text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        Deteksi Lokasi Otomatis
                                    </button>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="foto_rumah" class="block text-sm text-gray-700 font-semibold mb-1">Foto Rumah Depan</label>
                                        <input id="foto_rumah" name="foto_rumah" type="file" accept=".jpg,.jpeg,.png" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-[#1746A2] hover:file:bg-blue-100 cursor-pointer">
                                        <p class="text-[10px] text-gray-400 mt-1">*Maks 2MB (JPG/PNG)</p>
                                    </div>
                                    <div>
                                        <label for="foto_ktp" class="block text-sm text-gray-700 font-semibold mb-1">Foto e-KTP Asli</label>
                                        <input id="foto_ktp" name="foto_ktp" type="file" accept=".jpg,.jpeg,.png" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-[#FF731D] hover:file:bg-orange-100 cursor-pointer">
                                        <p class="text-[10px] text-gray-400 mt-1">*Maks 2MB (JPG/PNG)</p>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Tombol Aksi Bawah -->
                        <div class="flex items-center justify-end gap-4 pt-8 border-t border-gray-100 mt-8">
                            <a href="{{ route('user.home') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold px-8 py-3.5 rounded-xl transition duration-300">
                                Batal
                            </a>
                            <button type="submit" class="bg-[#FF731D] hover:bg-[#e06518] text-white font-bold px-8 py-3.5 rounded-xl shadow-lg shadow-orange-200 transition duration-300 transform hover:-translate-y-0.5 flex items-center">
                                Lanjutkan ke Pembayaran
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </button>
                        </div>
                    </form>
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

    <!-- Styles -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        body { font-family: 'Inter', sans-serif; }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const kecamatanSelect = document.getElementById('kecamatan_id');
        const kelurahanSelect = document.getElementById('kelurahan_id');
        const selectedKelurahan = kelurahanSelect.dataset.selected;

        async function loadKelurahan(kecamatanId) {
            kelurahanSelect.innerHTML = '<option value="" disabled selected>Memuat kelurahan...</option>';
            if (!kecamatanId) {
                kelurahanSelect.innerHTML = '<option value="" disabled selected>Pilih Kec. Terlebih Dahulu</option>';
                return;
            }

            try {
                const response = await fetch(`/get-kelurahan/${encodeURIComponent(kecamatanId)}`, {
                    headers: { 'Accept': 'application/json' }
                });
                if (!response.ok) {
                    throw new Error('Gagal');
                }

                const kelurahans = await response.json();
                kelurahanSelect.innerHTML = '<option value="" disabled selected>Pilih Kelurahan</option>';
                kelurahans.forEach((kelurahan) => {
                    const option = document.createElement('option');
                    option.value = kelurahan.id;
                    option.textContent = kelurahan.nama;
                    if (String(kelurahan.id) === selectedKelurahan) {
                        option.selected = true;
                    }
                    kelurahanSelect.appendChild(option);
                });
            } catch (error) {
                kelurahanSelect.innerHTML = '<option value="" disabled selected>Gagal memuat kelurahan</option>';
            }
        }

        kecamatanSelect.addEventListener('change', () => {
            loadKelurahan(kecamatanSelect.value);
        });

        if (kecamatanSelect.value) {
            loadKelurahan(kecamatanSelect.value);
        }

        document.getElementById('location-button').addEventListener('click', () => {
            if (!navigator.geolocation) {
                Swal.fire({ icon: 'error', title: 'Gagal', text: 'Browser Anda tidak mendukung deteksi lokasi.', confirmButtonColor: '#FF731D' });
                return;
            }

            // Memunculkan Loading SwatAlert2
            Swal.fire({
                title: 'Mencari Lokasi...',
                text: 'Mohon izinkan akses lokasi pada browser Anda.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            navigator.geolocation.getCurrentPosition(
                ({ coords }) => {
                    document.getElementById('latitude').value = coords.latitude;
                    document.getElementById('longitude').value = coords.longitude;
                    Swal.fire({ icon: 'success', title: 'Berhasil', text: 'Titik koordinat berhasil didapatkan!', timer: 2000, showConfirmButton: false });
                },
                () => {
                    Swal.fire({ icon: 'warning', title: 'Akses Ditolak', text: 'Pastikan GPS Anda menyala dan Anda mengizinkan akses lokasi pada pop-up browser.', confirmButtonColor: '#1746A2' });
                },
                { enableHighAccuracy: true, timeout: 10000 }
            );
        });
    </script>
</body>
</html>
