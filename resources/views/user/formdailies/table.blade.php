<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tabel Harian') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- Filter Panel & Bulan -->
                <form method="GET" action="{{ route('dailyTableCheck') }}" class="mb-4 grid grid-rows-4 md:grid-rows-2 md:grid-cols-2 lg:grid-rows-1 lg:grid-cols-4  gap-3">
                    <select name="lokasi_id" class="form-select px-3 py-2 border rounded"
                        onchange="this.form.submit()">
                        <option value="">-</option>
                        @foreach ($lokasis as $key => $lokasi)
                            <option value="{{ $key }}" {{ old('lokasi_id', $selectedLocation) == $key ? 'selected' : '' }}>
                                {{ $lokasi }}
                            </option>
                        @endforeach
                    </select>
                    <select name="panel_id" class="form-select px-3 py-2 border rounded"
                        onchange="this.form.submit()">
                        <option value="">-</option>
                        @foreach ($panels as $key => $panel)
                            <option value="{{ $key }}" {{ $selectedPanel == $key ? 'selected' : '' }}>
                                {{ $panel }}
                            </option>
                        @endforeach
                    </select>
                    <input type="month" name="bulan" value="{{ $tahun . '-' . $bulan }}"
                        onchange="this.form.submit()" class="form-input px-3 py-2 border rounded">
                    <a href="{{ route('dailyTableCheck.pdf', ['panel_id' => $selectedPanel, 'bulan' => $tahun . '-' . $bulan]) }}"
                        target="_blank" class="btn btn-red w-full sm:w-auto">
                        <i class="fas fa-file-pdf mr-1"></i> Export PDF
                    </a>
                </form>

                <!-- Tabel Absensi dengan Drag Scroll -->
                <div id="table-container"
                    class="overflow-auto whitespace-nowrap border rounded-lg cursor-grab active:cursor-grabbing"
                    style="user-select: none;">
                    <table class="table-auto w-full border-collapse border min-w-max">
                        <thead class="bg-gray-700 text-white">
                            <tr>
                                <th class="border text-center px-4 py-2 min-w-[200px]" rowspan="2">Item Pemeriksaan
                                </th>
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
                                    <td class="border px-4 py-2 text-left min-w-[200px]">{{ $item->item_pemeriksaan }}
                                    </td>
                                    @for ($i = 1; $i <= 31; $i++)
                                        @php
                                            $tanggal = sprintf('%s-%02d-%02d', $tahun, $bulan, $i);
                                            $dailyItem = optional(
                                                optional($checklists[$tanggal] ?? null)->items,
                                            )->firstWhere('form_checklist_item_id', $item->id);
                                            $kondisi = $dailyItem->kondisi ?? null;
                                            $keterangan = $dailyItem->keterangan ?? '';
                                        @endphp
                                        <td class="border px-2 py-2 min-w-[40px] text-center {{ $kondisi === 'baik' ? 'bg-green-500 text-white' : ($kondisi ? 'bg-red-500 text-white' : 'bg-gray-300') }}"
                                            data-kondisi="{{ $kondisi }}" data-keterangan="{{ $keterangan }}"
                                            onclick="showModal(this)">
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

    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-96">
            <h3 class="text-lg font-semibold mb-4">Detail Kondisi</h3>
            <p><strong>Kondisi:</strong> <span id="modal-kondisi"></span></p>
            <p><strong>Keterangan:</strong> <span id="modal-keterangan"></span></p>
            <button onclick="closeModal()" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">Tutup</button>
        </div>
    </div>

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
            const walk = (x - startX) * 2;
            tableContainer.scrollLeft = scrollLeft - walk;
        });

        function showModal(cell) {
            const kondisi = (cell.getAttribute('data-kondisi') || '-').charAt(0).toUpperCase() + (cell.getAttribute(
                'data-kondisi') || '-').slice(1);
            const keterangan = cell.getAttribute('data-keterangan') || '-';
            document.getElementById('modal-kondisi').textContent = kondisi;
            document.getElementById('modal-keterangan').textContent = keterangan;
            document.getElementById('modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }
    </script>

</x-app-layout>
