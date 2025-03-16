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
                    <select name="panel_id" class="form-select px-3 py-2 border rounded w-full sm:w-auto">
                        @foreach ($panels as $panel)
                            <option value="{{ $panel->id }}" {{ $selectedPanel == $panel->id ? 'selected' : '' }}>
                                {{ $panel->nama_panel }}
                            </option>
                        @endforeach
                    </select>
                    <input type="month" name="bulan" value="{{ $tahun . '-' . $bulan }}" class="form-input px-3 py-2 border rounded w-full sm:w-auto">
                    <button type="submit" class="btn btn-blue w-full sm:w-auto">
                        <i class="fas fa-level-up mr-1"></i> Update
                    </button>
                </form>

                <!-- Tabel Absensi dengan Drag Scroll -->
                <div id="table-container" class="overflow-auto whitespace-nowrap border rounded-lg cursor-grab active:cursor-grabbing" style="user-select: none;">
                    <table class="table-auto w-full border-collapse border min-w-max">
                        <thead class="bg-gray-700 text-white">
                            <tr>
                                <th class="border text-center px-4 py-2 min-w-[200px]" rowspan="2">Item Pemeriksaan</th>
                                <th class="border text-center px-2 py-2 min-w-[40px]" colspan="31">Tanggal</th>
                            </tr>
                            <tr>
                                @for ($i = 1; $i <= 31; $i++)
                                    <th class="border text-center px-2 py-2 min-w-[40px]">{{ $i }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr class="text-center">
                                    <td class="border px-4 py-2 text-left min-w-[200px]">{{ $item->item_pemeriksaan }}</td>
                                    @for ($i = 1; $i <= 31; $i++)
                                        @php
                                            $tanggal = sprintf('%s-%02d-%02d', $tahun, $bulan, $i);
                                            $dailyItem = optional(
                                                optional($checklists[$tanggal] ?? null)->items,
                                            )->firstWhere('form_checklist_item_id', $item->id);
                                            $kondisi = $dailyItem->kondisi ?? null;
                                        @endphp
                                        <td class="border px-2 py-2 min-w-[40px] text-center {{ $kondisi === 'baik' ? 'bg-green-500 text-white' : ($kondisi ? 'bg-red-500 text-white' : 'bg-gray-300') }}">
                                            {{ $kondisi ? ($kondisi === 'baik' ? 'B' : 'TB') : '-' }}
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

    <!-- Script untuk Drag Scroll -->
    <script>
        const tableContainer = document.getElementById('table-container');
        let isDown = false;
        let startX;
        let scrollLeft;

        tableContainer.addEventListener('mousedown', (e) => {
            isDown = true;
            tableContainer.classList.add('active');
            startX = e.pageX - tableContainer.offsetLeft;
            scrollLeft = tableContainer.scrollLeft;
        });

        tableContainer.addEventListener('mouseleave', () => {
            isDown = false;
            tableContainer.classList.remove('active');
        });

        tableContainer.addEventListener('mouseup', () => {
            isDown = false;
            tableContainer.classList.remove('active');
        });

        tableContainer.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - tableContainer.offsetLeft;
            const walk = (x - startX) * 2; // Kecepatan geser
            tableContainer.scrollLeft = scrollLeft - walk;
        });
    </script>

</x-app-layout>
