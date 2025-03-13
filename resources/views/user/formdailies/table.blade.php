<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Checklist Harian') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- Filter Panel & Bulan -->
                <form method="GET" action="{{ route('dailyTableCheck') }}" class="mb-4 flex flex-wrap gap-3">
                    <select name="panel_id" class="form-select px-3 py-2 border rounded">
                        @foreach ($panels as $panel)
                            <option value="{{ $panel->id }}" {{ $selectedPanel == $panel->id ? 'selected' : '' }}>
                                {{ $panel->nama_panel }}
                            </option>
                        @endforeach
                    </select>
                    <input type="month" name="bulan" value="{{ $tahun . '-' . $bulan }}"
                        class="form-input px-3 py-2 border rounded">
                    <button type="submit" class="btn btn-blue">
                        <i class="fas fa-filter mr-1"></i> Filter
                    </button>
                </form>

                <!-- Tabel Absensi -->
                <div class="overflow-x-auto">
                    <table class="table-auto w-full border-collapse border">
                        <thead class="bg-gray-700 text-white">
                            <tr>
                                <th class="border px-4 py-2">Item Pemeriksaan</th>
                                @for ($i = 1; $i <= 31; $i++)
                                    <th class="border px-2 py-2">{{ $i }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr class="text-center">
                                    <td class="border px-4 py-2 text-left">{{ $item->item_pemeriksaan }}</td>
                                    @for ($i = 1; $i <= 31; $i++)
                                        @php
                                            $tanggal = sprintf('%s-%02d-%02d', $tahun, $bulan, $i);
                                            $dailyItem = optional(
                                                optional($checklists[$tanggal] ?? null)->items,
                                            )->firstWhere('form_checklist_item_id', $item->id);
                                            $kondisi = $dailyItem->kondisi ?? null;
                                        @endphp
                                        <td
                                            class="border px-2 py-2 {{ $kondisi === 'baik' ? 'bg-green-500 text-white' : ($kondisi ? 'bg-red-500 text-white' : 'bg-gray-300') }}">
                                            {{ $kondisi ? ucfirst($kondisi) : '-' }}
                                        </td>
                                    @endfor
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
