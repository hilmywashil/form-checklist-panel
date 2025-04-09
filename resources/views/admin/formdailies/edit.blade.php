<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Kondisi Item Pemeriksaan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('formCheckDailyUpdate', $daily->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white dark:bg-gray-900 rounded-lg shadow">
                                <thead class="bg-gray-200 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-4 py-2 text-left">Item Pemeriksaan</th>
                                        <th class="px-4 py-2 text-left">Kondisi</th>
                                        <th class="px-4 py-2 text-left">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($daily->items as $item)
                                        <tr class="border dark:border-gray-700">
                                            <td class="px-4 py-2">{{ $item->item->item_pemeriksaan }}</td>
                                            <td class="px-4 py-2">
                                                <select name="kondisi[{{ $item->form_checklist_item_id ?? 'default_id' }}]"
                                                    class="form-input w-full">
                                                    <option value="baik"
                                                        {{ $item->kondisi == 'baik' ? 'selected' : '' }}>Baik</option>
                                                    <option value="tidak baik"
                                                        {{ $item->kondisi == 'tidak baik' ? 'selected' : '' }}>Tidak
                                                        Baik</option>
                                                </select>
                                            </td>
                                            <td class="px-4 py-2 truncate-text" title="{{ Str::limit($item->item->keterangan, 100) }}">
                                                <input type="text" name="keterangan[{{ $item->form_checklist_item_id }}]" 
                                                    value="{{ $item->keterangan ?? '' }}" 
                                                    class="form-input w-full">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4 hover:bg-blue-600">
                            <i class="fas fa-save mr-1"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
