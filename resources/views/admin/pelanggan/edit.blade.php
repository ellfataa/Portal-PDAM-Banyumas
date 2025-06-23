<!-- NGGAK DI PAKE -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDAM Banyumas - Edit Pendaftaran Pelanggan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FFFFFF] text-gray-800 antialiased font-sans">
    <div class="min-h-screen flex flex-col">

        <!-- Header Section (Navbar for Admin) -->
        <header class="bg-white text-gray-800 shadow-lg py-4 px-6 md:px-8">
            <div class="max-w-7xl mx-auto flex flex-wrap justify-between items-center">
                <!-- Logo and Title -->
                <div class="flex items-center space-x-3 sm:space-x-4 mb-2 md:mb-0">
                    <img src="{{ asset('images/logo-pdam.png') }}" alt="Logo PDAM Banyumas" class="h-10 w-25 sm:h-12 sm:w-27">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-[#1746A2]">PDAM Banyumas</h1>
                        <p class="text-sm text-gray-600 font-medium">Panel Administrator</p>
                    </div>
                </div>

                <!-- Admin Info & Logout (Dropdown Menu) -->
                <nav class="w-full md:w-auto flex justify-center md:justify-end items-center space-x-4 sm:space-x-6 text-base font-medium relative">
                    <div x-data="{ open: false }" @click.away="open = false" class="relative">
                        <button @click="open = !open" class="flex items-center text-gray-700 hover:text-[#1746A2] focus:outline-none focus:ring-2 focus:ring-[#5F9DF7] focus:ring-opacity-50 px-3 py-2 rounded-lg transition duration-300 ease-in-out">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-[#1746A2] rounded-full flex items-center justify-center mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                Admin {{ Auth::user()->name }}
                            </div>
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
                <!-- Tombol Kembali -->
                <div class="mb-4 text-start w-full">
                    <a href="{{ route('admin.pelanggan.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-[#1746A2] transition duration-300 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Daftar Pendaftaran Pelanggan
                    </a>
                </div>

                <div class="text-center mb-12">
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-[#1746A2] mb-4">Edit Data Pendaftaran Pelanggan</h2>
                    <p class="text-gray-700 text-lg max-w-2xl mx-auto">
                        Perbarui informasi pendaftaran untuk <strong>{{ $pendaftaran->nama_lengkap }}</strong>.
                    </p>
                </div>

                <!-- Notifikasi Status -->
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative mb-4" role="alert">
                        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                    {{-- Form ini akan mengupdate PendaftaranPelanggan dan juga User terkait --}}
                    <form method="POST" action="{{ route('admin.pelanggan.update', $pendaftaran->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Lengkap (dari PendaftaranPelanggan) -->
                            <div>
                                <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap', $pendaftaran->nama_lengkap) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                @error('nama_lengkap')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email (dari User terkait) -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Akun</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $pendaftaran->user->email ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password (Opsional, untuk User terkait) -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password Akun Baru (kosongkan jika tidak ingin mengubah)</label>
                                <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Konfirmasi Password (untuk User terkait) -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Akun Baru</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>

                            <!-- Pekerjaan (dari PendaftaranPelanggan) -->
                            <div>
                                <label for="pekerjaan" class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan</label>
                                <input type="text" name="pekerjaan" id="pekerjaan" value="{{ old('pekerjaan', $pendaftaran->pekerjaan ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('pekerjaan')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Kecamatan (dari PendaftaranPelanggan) -->
                            <div>
                                <label for="kecamatan_id" class="block text-sm font-medium text-gray-700 mb-2">Kecamatan</label>
                                <select name="kecamatan_id" id="kecamatan_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Pilih Kecamatan</option>
                                    @foreach ($kecamatans as $kecamatan)
                                        <option value="{{ $kecamatan->id }}" {{ old('kecamatan_id', $pendaftaran->kecamatan_id ?? '') == $kecamatan->id ? 'selected' : '' }}>
                                            {{ $kecamatan->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kecamatan_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Kelurahan (dari PendaftaranPelanggan) -->
                            <div>
                                <label for="kelurahan_id" class="block text-sm font-medium text-gray-700 mb-2">Kelurahan</label>
                                <select name="kelurahan_id" id="kelurahan_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Pilih Kelurahan</option>
                                    {{-- Opsi kelurahan akan dimuat via JavaScript --}}
                                    @if($kelurahans->isNotEmpty())
                                        @foreach ($kelurahans as $kelurahan)
                                            <option value="{{ $kelurahan->id }}" {{ old('kelurahan_id', $pendaftaran->kelurahan_id ?? '') == $kelurahan->id ? 'selected' : '' }}>
                                                {{ $kelurahan->nama }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('kelurahan_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Latitude (dari PendaftaranPelanggan) -->
                            <div>
                                <label for="latitude" class="block text-sm font-medium text-gray-700 mb-2">Latitude</label>
                                <input type="text" name="latitude" id="latitude" value="{{ old('latitude', $pendaftaran->latitude ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('latitude')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Longitude (dari PendaftaranPelanggan) -->
                            <div>
                                <label for="longitude" class="block text-sm font-medium text-gray-700 mb-2">Longitude</label>
                                <input type="text" name="longitude" id="longitude" value="{{ old('longitude', $pendaftaran->longitude ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('longitude')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Foto Rumah (dari PendaftaranPelanggan) -->
                            <div>
                                <label for="foto_rumah" class="block text-sm font-medium text-gray-700 mb-2">Foto Rumah (kosongkan jika tidak ingin mengubah)</label>
                                <input type="file" name="foto_rumah" id="foto_rumah" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-[#1746A2] file:text-white hover:file:bg-[#5F9DF7]">
                                @error('foto_rumah')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                @if ($pendaftaran->foto_rumah)
                                    <p class="text-xs text-gray-500 mt-2">Foto saat ini:</p>
                                    <img src="{{ Storage::url($pendaftaran->foto_rumah) }}" alt="Foto Rumah" class="mt-2 w-32 h-auto rounded-md shadow">
                                @endif
                            </div>

                            <!-- Foto KTP (dari PendaftaranPelanggan) -->
                            <div>
                                <label for="foto_ktp" class="block text-sm font-medium text-gray-700 mb-2">Foto KTP (kosongkan jika tidak ingin mengubah)</label>
                                <input type="file" name="foto_ktp" id="foto_ktp" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-[#1746A2] file:text-white hover:file:bg-[#5F9DF7]">
                                @error('foto_ktp')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                @if ($pendaftaran->foto_ktp)
                                    <p class="text-xs text-gray-500 mt-2">Foto saat ini:</p>
                                    <img src="{{ Storage::url($pendaftaran->foto_ktp) }}" alt="Foto KTP" class="mt-2 w-32 h-auto rounded-md shadow">
                                @endif
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-[#1746A2] hover:bg-[#5F9DF7] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1746A2] transition duration-300 ease-in-out">
                                Perbarui Pendaftaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>

        <!-- Footer Section -->
        <footer class="bg-[#1746A2] text-white text-center py-5 text-sm font-light">
            <div class="max-w-7xl mx-auto px-6">
                &copy; {{ date('Y') }} PDAM Banyumas. Panel Administrator - Seluruh hak cipta dilindungi.
            </div>
        </footer>
    </div>

    <script>
        // Fungsi untuk memuat kelurahan berdasarkan ID kecamatan
        function loadKelurahan(kecamatanId, selectedKelurahanId = '') {
            const kelurahanSelect = document.getElementById('kelurahan_id');
            // Hapus semua opsi lama
            kelurahanSelect.innerHTML = '<option value="">Memuat Kelurahan...</option>';

            // Hanya lakukan fetch jika kecamatanId valid (tidak kosong atau null)
            if (kecamatanId) {
                fetch(`/get-kelurahan/${kecamatanId}`)
                    .then(response => {
                        if (!response.ok) { // Jika respons bukan 200 OK
                            // Log error detail dari respons jika ada
                            return response.text().then(text => { throw new Error('Network response was not ok: ' + response.status + ' ' + response.statusText + ' - ' + text); });
                        }
                        return response.json();
                    })
                    .then(data => {
                        kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
                        if (data.length === 0) {
                            kelurahanSelect.innerHTML = '<option value="">Tidak ada Kelurahan ditemukan</option>';
                        } else {
                            data.forEach(kelurahan => {
                                const option = document.createElement('option');
                                option.value = kelurahan.id;
                                option.textContent = kelurahan.nama;
                                kelurahanSelect.appendChild(option);
                            });
                            // Pilih kelurahan yang sudah ada jika ada initial value atau old value
                            if (selectedKelurahanId) {
                                kelurahanSelect.value = selectedKelurahanId;
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching kelurahan:', error);
                        kelurahanSelect.innerHTML = '<option value="">Gagal memuat Kelurahan</option>';
                    });
            } else {
                // Jika tidak ada kecamatan yang dipilih, reset kelurahan
                kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
            }
        }

        // Event listener untuk perubahan dropdown kecamatan
        document.getElementById('kecamatan_id').addEventListener('change', function() {
            // Ketika kecamatan berubah, muat kelurahan baru dan jangan langsung set nilai lama
            // karena itu untuk kasus load awal atau validasi gagal.
            loadKelurahan(this.value);
        });

        // Panggil fungsi loadKelurahan saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil ID kecamatan yang seharusnya terpilih saat halaman pertama kali dimuat
            // Ini bisa dari old() input (jika ada validasi error) atau dari data $pendaftaran
            // Menggunakan operator ?? '' untuk memastikan tidak ada undefined/null
            const initialKecamatanId = "{{ old('kecamatan_id', $pendaftaran->kecamatan_id ?? '') }}";
            const initialKelurahanId = "{{ old('kelurahan_id', $pendaftaran->kelurahan_id ?? '') }}";

            // Jika ada initialKecamatanId yang valid (bukan string kosong atau null)
            if (initialKecamatanId) {
                // Pastikan dropdown kecamatan sudah terisi dengan nilai initialKecamatanId
                document.getElementById('kecamatan_id').value = initialKecamatanId;
                // Panggil loadKelurahan dengan ID kecamatan dan ID kelurahan yang ingin dipilih
                loadKelurahan(initialKecamatanId, initialKelurahanId);
            } else {
                // Jika tidak ada initialKecamatanId (misal, untuk data lama yang NULL)
                // Pastikan dropdown kelurahan di-reset ke "Pilih Kelurahan"
                document.getElementById('kelurahan_id').innerHTML = '<option value="">Pilih Kelurahan</option>';
            }
        });
    </script>
</body>
</html>
