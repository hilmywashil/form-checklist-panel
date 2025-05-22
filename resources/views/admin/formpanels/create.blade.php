<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Buat Form Panel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('formpanelStore') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="block font-bold text-gray-700 dark:text-gray-300">
                                NAMA PANEL
                            </label>
                            <input type="text"
                                class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 
                                   dark:border-gray-600 dark:text-white @error('nama_panel') border-red-500 @enderror"
                                name="nama_panel" value="{{ old('nama_panel') }}" placeholder="Masukkan Nama Panel">
                            @error('nama_panel')
                                <p class="text-red-500 text-sm mt-1">Nama Panel tidak boleh kosong!</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block font-bold text-gray-700 dark:text-gray-300">
                                LOKASI
                            </label>
                            <select name="lokasi"
                                class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 
                                   dark:border-gray-600 dark:text-white @error('lokasi') border-red-500 @enderror">
                                <option value="" disabled selected> Pilih Lokasi </option>
                                @foreach ($lokasiList as $lokasi)
                                    <option value="{{ $lokasi->id }}"
                                        {{ old('lokasi') == $lokasi->id ? 'selected' : '' }}>
                                        {{ $lokasi->nama_lokasi }}
                                    </option>
                                @endforeach
                            </select>
                            @error('lokasi')
                                <p class="text-red-500 text-sm mt-1">Lokasi tidak boleh kosong!</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block font-bold text-gray-700 dark:text-gray-300">
                                NAMA PEKERJAAN
                            </label>
                            <input type="text"
                                class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 
                                   dark:border-gray-600 dark:text-white @error('nama_pekerjaan') border-red-500 @enderror"
                                name="nama_pekerjaan" value="{{ old('nama_pekerjaan') }}"
                                placeholder="Masukkan Nama Pekerjaan (Opsional)">
                            @error('nama_pekerjaan')
                                <p class="text-red-500 text-sm mt-1">Nama Pekerjaan tidak boleh kosong!</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block font-bold text-gray-700 dark:text-gray-300">
                                NOMOR SPK
                            </label>
                            <input type="text"
                                class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 
                                   dark:border-gray-600 dark:text-white @error('nomor_spk') border-red-500 @enderror"
                                name="nomor_spk" value="{{ old('nomor_spk') }}" placeholder="Masukkan Nomor SPK (Opsional)">
                            @error('nomor_spk')
                                <p class="text-red-500 text-sm mt-1">Nomor SPK tidak boleh kosong!</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block font-bold text-gray-700 dark:text-gray-300">
                                TANGGAL SPK
                            </label>
                            <input type="date"
                                class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 
                                   dark:border-gray-600 dark:text-white @error('tanggal_spk') border-red-500 @enderror"
                                name="tanggal_spk" value="{{ old('tanggal_spk') }}">
                            @error('tanggal_spk')
                                <p class="text-red-500 text-sm mt-1">Tanggal SPK boleh kosong!</p>
                            @enderror
                        </div>

                        <div class="flex flex-col md:flex-row gap-2">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                <i class="fas fa-save"></i> SIMPAN
                            </button>
                            <button type="reset"
                                class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
                                <i class="fas fa-undo-alt"></i> RESET
                            </button>
                            <a href="{{ route('adminFormpanels') }}"
                                class="px-4 py-2 text-center bg-red-600 text-white rounded-md hover:bg-red-700">
                                <i class="fas fa-arrow-left"></i> KEMBALI
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" defer></script>
    @endpush
</x-app-layout>
