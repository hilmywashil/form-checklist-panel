<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Data Pemeriksaan Harian
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if ($checklists->isEmpty())
                        <p class="text-gray-500 dark:text-gray-400 text-center">Belum ada checklist harian.</p>
                    @else
                        <div class="space-y-4">
                            @foreach ($checklists->groupBy('tanggal') as $tanggal => $dailyChecklists)
                                <details class="bg-gray-100 dark:bg-gray-700 rounded-lg shadow p-4">
                                    <summary
                                        class="cursor-pointer font-semibold text-lg text-gray-800 dark:text-gray-200">
                                        {{ \Carbon\Carbon::parse($tanggal)->locale('id')->translatedFormat('l, d F Y') }}
                                    </summary>
                                    <div class="overflow-x-auto mt-3">
                                        <table class="min-w-full bg-white dark:bg-gray-900 rounded-lg shadow">
                                            <thead class="bg-gray-200 dark:bg-gray-700">
                                                <tr>
                                                    <th class="px-4 py-2 text-left">Panel</th>
                                                    <th class="px-4 py-2 text-left">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dailyChecklists as $checklist)
                                                    <tr class="border-b dark:border-gray-700">
                                                        <td class="px-4 py-2">{{ $checklist->panel->nama_panel }}</td>
                                                        <td class="px-4 py-2">
                                                            <div class="flex flex-wrap items-center gap-2">
                                                                <a href="{{ route('userChecklistDailyShow', $checklist->id) }}"
                                                                    class="btn btn-blue">
                                                                    <i class="fas fa-edit mr-1"></i> Periksa
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </details>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
