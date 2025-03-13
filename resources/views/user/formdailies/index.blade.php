<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Checklist Harian
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <div class="overflow-x-auto mt-4">
                        <table class="table-auto w-full border border-gray-300 rounded-lg">
                            <thead class="bg-gray-200 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-2 text-left">Tanggal</th>
                                    <th class="px-4 py-2 text-left">Panel</th>
                                    <th class="px-4 py-2 text-left">Periksa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($checklists as $checklist)
                                    <tr class="border-b dark:border-gray-700">
                                        <td class="px-4 py-2">{{ $checklist->tanggal }}</td>
                                        <td class="px-4 py-2">{{ $checklist->panel->nama_panel }}</td>
                                        <td class="px-4 py-2">
                                            <a href="{{ route('userChecklistDailyShow', $checklist->id) }}" class="btn btn-blue">
                                                <i class="fas fa-edit mr-1"></i> Periksa
                                            </a>
                                        </td>
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
