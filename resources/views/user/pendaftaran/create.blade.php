<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Pendaftaran Pelanggan PDAM</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-xl bg-white p-6 shadow sm:p-8">
                <p class="mb-6 text-sm text-gray-600">Lengkapi data dan unggah dokumen untuk mengajukan sambungan baru.</p>

                @if ($errors->any())
                    <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                        <p class="font-semibold">Periksa kembali data berikut:</p>
                        <ul class="mt-2 list-inside list-disc">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('pendaftaran.store') }}" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="nama_lengkap" class="mb-1 block text-sm font-medium text-gray-700">Nama lengkap</label>
                            <input id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', auth()->user()->name) }}" required maxlength="255" class="w-full rounded-lg border-gray-300">
                        </div>
                        <div>
                            <label for="pekerjaan" class="mb-1 block text-sm font-medium text-gray-700">Pekerjaan</label>
                            <input id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan') }}" required maxlength="255" class="w-full rounded-lg border-gray-300">
                        </div>
                        <div>
                            <label for="kecamatan_id" class="mb-1 block text-sm font-medium text-gray-700">Kecamatan</label>
                            <select id="kecamatan_id" name="kecamatan_id" required class="w-full rounded-lg border-gray-300">
                                <option value="">Pilih kecamatan</option>
                                @foreach ($kecamatans as $kecamatan)
                                    <option value="{{ $kecamatan->id }}" @selected(old('kecamatan_id') == $kecamatan->id)>{{ $kecamatan->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="kelurahan_id" class="mb-1 block text-sm font-medium text-gray-700">Kelurahan</label>
                            <select id="kelurahan_id" name="kelurahan_id" required class="w-full rounded-lg border-gray-300" data-selected="{{ old('kelurahan_id') }}">
                                <option value="">Pilih kecamatan terlebih dahulu</option>
                            </select>
                        </div>
                        <div>
                            <label for="latitude" class="mb-1 block text-sm font-medium text-gray-700">Latitude</label>
                            <input id="latitude" name="latitude" type="number" step="any" value="{{ old('latitude') }}" required class="w-full rounded-lg border-gray-300">
                        </div>
                        <div>
                            <label for="longitude" class="mb-1 block text-sm font-medium text-gray-700">Longitude</label>
                            <input id="longitude" name="longitude" type="number" step="any" value="{{ old('longitude') }}" required class="w-full rounded-lg border-gray-300">
                        </div>
                        <div>
                            <label for="foto_rumah" class="mb-1 block text-sm font-medium text-gray-700">Foto rumah (JPG/PNG, maks. 2 MB)</label>
                            <input id="foto_rumah" name="foto_rumah" type="file" accept=".jpg,.jpeg,.png" required class="w-full rounded-lg border border-gray-300 p-2">
                        </div>
                        <div>
                            <label for="foto_ktp" class="mb-1 block text-sm font-medium text-gray-700">Foto KTP (JPG/PNG, maks. 2 MB)</label>
                            <input id="foto_ktp" name="foto_ktp" type="file" accept=".jpg,.jpeg,.png" required class="w-full rounded-lg border border-gray-300 p-2">
                        </div>
                    </div>
                    <button id="location-button" type="button" class="rounded-lg border border-blue-700 px-4 py-2 text-sm font-medium text-blue-700 hover:bg-blue-50">Gunakan lokasi perangkat</button>
                    <div class="flex flex-wrap gap-3 pt-2">
                        <button type="submit" class="rounded-lg bg-blue-700 px-5 py-2.5 font-semibold text-white hover:bg-blue-800">Kirim pendaftaran</button>
                        <a href="{{ route('user.home') }}" class="rounded-lg border border-gray-300 px-5 py-2.5 font-medium text-gray-700 hover:bg-gray-50">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const kecamatanSelect = document.getElementById('kecamatan_id');
        const kelurahanSelect = document.getElementById('kelurahan_id');
        const selectedKelurahan = kelurahanSelect.dataset.selected;

        async function loadKelurahan(kecamatanId) {
            kelurahanSelect.innerHTML = '<option value="">Memuat kelurahan...</option>';
            if (!kecamatanId) {
                kelurahanSelect.innerHTML = '<option value="">Pilih kecamatan terlebih dahulu</option>';
                return;
            }

            const response = await fetch(`/get-kelurahan/${encodeURIComponent(kecamatanId)}`, {
                headers: { 'Accept': 'application/json' }
            });
            if (!response.ok) {
                throw new Error('Daftar kelurahan gagal dimuat.');
            }

            const kelurahans = await response.json();
            kelurahanSelect.innerHTML = '<option value="">Pilih kelurahan</option>';
            kelurahans.forEach((kelurahan) => {
                const option = document.createElement('option');
                option.value = kelurahan.id;
                option.textContent = kelurahan.nama;
                option.selected = String(kelurahan.id) === selectedKelurahan;
                kelurahanSelect.appendChild(option);
            });
        }

        kecamatanSelect.addEventListener('change', () => {
            loadKelurahan(kecamatanSelect.value).catch((error) => {
                kelurahanSelect.innerHTML = '<option value="">Gagal memuat kelurahan</option>';
                console.error(error);
            });
        });

        if (kecamatanSelect.value) {
            loadKelurahan(kecamatanSelect.value).catch((error) => {
                kelurahanSelect.innerHTML = '<option value="">Gagal memuat kelurahan</option>';
                console.error(error);
            });
        }

        document.getElementById('location-button').addEventListener('click', () => {
            if (!navigator.geolocation) {
                alert('Browser ini tidak mendukung geolokasi.');
                return;
            }

            navigator.geolocation.getCurrentPosition(
                ({ coords }) => {
                    document.getElementById('latitude').value = coords.latitude;
                    document.getElementById('longitude').value = coords.longitude;
                },
                () => alert('Lokasi tidak dapat diakses. Periksa izin lokasi atau isi koordinat secara manual.')
            );
        });
    </script>
</x-app-layout>
