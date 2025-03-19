<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Item Pemeriksaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('formitemUpdate', $formitem->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- KETERANGAN -->
                        <div class="mb-4">
                            <label class="block font-bold text-gray-700 dark:text-gray-300">KETERANGAN</label>
                            <textarea
                                class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                      @error('keterangan') border-red-500 @enderror"
                                name="keterangan" rows="3" placeholder="Masukkan Keterangan">{{ old('keterangan', $formitem->keterangan) }}</textarea>
                            @error('keterangan')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- BUTTONS -->
                        <div class="flex space-x-2">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                <i class="fas fa-save mr-2"></i> SIMPAN
                            </button>
                            <a href="{{ url()->previous() }}"
                                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                                <i class="fas fa-arrow-left mr-2"></i> KEMBALI
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
