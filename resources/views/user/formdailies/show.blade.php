<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Periksa Checklist Harian - {{ $daily->tanggal }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full border border-gray-300 rounded-lg">
                            <thead class="bg-gray-200 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-2 text-left">Item Pemeriksaan</th>
                                    <th class="px-4 py-2 text-left">Kondisi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($daily->items as $item)
                                    <tr class="border-b dark:border-gray-700">
                                        <td class="px-4 py-2">{{ $item->item->item_pemeriksaan }}</td>
                                        <td class="px-4 py-2 capitalize">{{ $item->kondisi }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
