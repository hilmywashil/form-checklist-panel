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
                    <form action="{{ route('formpanels.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="block font-bold text-gray-700 dark:text-gray-300">
                                <i class="fas fa-layer-group"></i> NAMA PANEL
                            </label>
                            <input type="text" class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 
                                   dark:border-gray-600 dark:text-white @error('nama_panel') border-red-500 @enderror"
                                   name="nama_panel" value="{{ old('nama_panel') }}" placeholder="Masukkan Nama Panel">
                            @error('nama_panel')
                                <p class="text-red-500 text-sm mt-1">Nama Panel tidak boleh kosong!</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block font-bold text-gray-700 dark:text-gray-300">
                                <i class="fas fa-map-marker-alt"></i> LOKASI
                            </label>
                            <input type="text" class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 
                                   dark:border-gray-600 dark:text-white @error('lokasi') border-red-500 @enderror"
                                   name="lokasi" value="{{ old('lokasi') }}" placeholder="Masukkan Lokasi">
                            @error('lokasi')
                                <p class="text-red-500 text-sm mt-1">Lokasi tidak boleh kosong!</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block font-bold text-gray-700 dark:text-gray-300">
                                <i class="fas fa-calendar-alt"></i> TANGGAL
                            </label>
                            <input type="date" class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 
                                   dark:border-gray-600 dark:text-white @error('tanggal') border-red-500 @enderror"
                                   name="tanggal" value="{{ old('tanggal') }}">
                            @error('tanggal')
                                <p class="text-red-500 text-sm mt-1">Tanggal tidak boleh kosong!</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block font-bold text-gray-700 dark:text-gray-300">
                                <i class="fas fa-user"></i> TEKNISI
                            </label>
                            <input type="text" class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 
                                   dark:border-gray-600 dark:text-white @error('teknisi') border-red-500 @enderror"
                                   name="teknisi" value="{{ old('teknisi') }}" placeholder="Masukkan Nama Teknisi">
                            @error('teknisi')
                                <p class="text-red-500 text-sm mt-1">Nama teknisi tidak boleh kosong!</p>
                            @enderror
                        </div>

                        <div class="flex space-x-2">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                <i class="fas fa-save"></i> SIMPAN
                            </button>
                            <button type="reset" class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
                                <i class="fas fa-undo-alt"></i> RESET
                            </button>
                            <a href="{{ route('formpanels.index') }}" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
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
