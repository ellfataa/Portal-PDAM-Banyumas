<section x-data="{ openModal: {{ $errors->userDeletion->isNotEmpty() ? 'true' : 'false' }} }">
    <header class="mb-6">
        <h2 class="text-2xl font-extrabold text-red-600 mb-2">
            {{ __('Hapus Akun') }}
        </h2>
        <p class="text-sm text-gray-500 font-medium">
            {{ __('Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Harap unduh informasi yang ingin Anda simpan sebelum melanjutkan.') }}
        </p>
    </header>

    <div class="mt-8 pt-4 border-t border-gray-100">
        <button @click="openModal = true" type="button" class="bg-red-50 text-red-600 border border-red-200 hover:bg-red-600 hover:text-white font-bold py-2.5 px-8 rounded-xl transition duration-300">
            {{ __('Hapus Akun Permanen') }}
        </button>
    </div>

    <!-- Modal Confirmation for Delete Account -->
    <div x-show="openModal" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
         class="fixed inset-0 z-50 flex items-center justify-center p-4" style="display: none;">

        <!-- Overlay -->
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm" @click="openModal = false"></div>

        <!-- Modal Content -->
        <div class="relative bg-white rounded-3xl shadow-2xl p-8 w-full max-w-md mx-auto z-50">
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <h2 class="text-xl font-extrabold text-gray-900 mb-4">
                    {{ __('Apakah Anda yakin ingin menghapus akun?') }}
                </h2>

                <p class="text-sm text-gray-600 mb-6 leading-relaxed">
                    {{ __('Tindakan ini tidak dapat dibatalkan. Harap masukkan password Anda untuk mengkonfirmasi penghapusan akun permanen.') }}
                </p>

                <div class="mb-6">
                    <label for="password_delete" class="sr-only">{{ __('Password') }}</label>
                    <input
                        id="password_delete"
                        name="password"
                        type="password"
                        class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:border-red-500 focus:bg-white focus:ring focus:ring-red-500 focus:ring-opacity-20 transition duration-300"
                        placeholder="{{ __('Masukkan password Anda') }}"
                    />
                    @error('password', 'userDeletion')
                        <p class="mt-2 text-red-500 text-xs font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" @click="openModal = false" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold px-6 py-2.5 rounded-xl transition duration-300">
                        {{ __('Batal') }}
                    </button>

                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold px-6 py-2.5 rounded-xl shadow-lg shadow-red-200 transition duration-300">
                        {{ __('Ya, Hapus Akun') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
