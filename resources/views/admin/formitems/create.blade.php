<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Buat Form Item Pemeriksaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('formitems.store') }}" method="POST">
                        @csrf

                        <!-- ITEM PEMERIKSAAN -->
                        <div class="mb-4">
                            <label class="block font-bold text-gray-700 dark:text-gray-300">ITEM PEMERIKSAAN</label>
                            <input type="text"
                                class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white 
                                   @error('item_pemeriksaan') border-red-500 @enderror"
                                name="item_pemeriksaan" value="{{ old('item_pemeriksaan') }}"
                                placeholder="Masukkan Item Pemeriksaan">
                            @error('item_pemeriksaan')
                                <p class="text-red-500 text-sm mt-1">Item Pemeriksaan tidak boleh kosong!</p>
                            @enderror
                        </div>

                        <!-- KETERANGAN -->
                        <div class="mb-4">
                            <label class="block font-bold text-gray-700 dark:text-gray-300">KETERANGAN
                                (Opsional)</label>
                            <textarea
                                class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white 
                                      @error('keterangan') border-red-500 @enderror"
                                name="keterangan" rows="3" placeholder="Masukkan Keterangan">{{ old('keterangan') }}</textarea>
                        </div>

                        <!-- PANEL -->
                        <div class="mb-4">
                            <label class="block font-bold text-gray-700 dark:text-gray-300">PANEL</label>
                            <select name="panel_id"
                                class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white 
                                    @error('panel_id') border-red-500 @enderror">
                                <option value="">Pilih Panel</option>
                                @foreach ($panels as $panel)
                                    <option value="{{ $panel->id }}"
                                        {{ isset($panel_id) && $panel_id == $panel->id ? 'selected' : '' }}>
                                        {{ $panel->nama_panel }}
                                    </option>
                                @endforeach
                            </select>
                            @error('panel_id')
                                <p class="text-red-500 text-sm mt-1">Pilih salah satu panel!</p>
                            @enderror
                        </div>

                        <!-- BUTTONS -->
                        <div class="flex space-x-2">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                SIMPAN
                            </button>
                            <button type="reset"
                                class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
                                RESET
                            </button>
                            <a href="{{ url()->previous() }}"
                                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                                KEMBALI
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
