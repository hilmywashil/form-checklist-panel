<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Laporan Harian - Panel: {{ $panel->nama_panel }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Form Input Tanggal -->
                    <form method="GET" action="{{ route('laporanHarianDetail', $panel->id) }}" class="mb-6">
                        <label for="tanggal" class="text-lg font-semibold">Tanggal:</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-input w-full max-w-xs mt-2"
                            value="{{ $selectedDate }}" onchange="this.form.submit()">
                    </form>

                    <!-- Pesan Status Pemeriksaan Panel -->
                    <div class="mb-4">
                        <span class="text-lg font-semibold">
                            @if ($panelStatus === 'Panel diperiksa')
                                ✅ Panel telah diperiksa
                            @else
                                ❌ Panel belum diperiksa
                            @endif
                        </span>
                    </div>

                    <!-- Informasi Panel & QR Code -->
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h1 class="text-2xl font-bold mb-2">LAPORAN HARIAN</h1>

                            <h3 class="text-lg font-semibold">Nama Panel: <span
                                    class="font-normal">{{ $panel->nama_panel }}</span></h3>
                            <h3 class="text-lg font-semibold">Lokasi Panel: <span
                                    class="font-normal">{{ $panel->lokasiRel->nama_lokasi }}</span></h3>
                            <h3 class="text-lg font-semibold">Pekerjaan: <span
                                    class="font-normal">{{ $panel->nama_pekerjaan ?? '-' }}</span></h3>
                            <h3 class="text-lg font-semibold">Nomor SPK: <span
                                    class="font-normal">{{ $panel->nomor_spk ?? '-' }}</span></h3>
                        </div>

                        @if ($daily && $daily->id)
                            <div class="text-center -mr-14">
                                <img src="{{ asset('storage/qrcodes/ceklis_' . $daily->id . '.png') }}" alt="QR Code"
                                    class="w-50 h-50 mx-auto">
                                <a href="{{ asset('storage/qrcodes/ceklis_' . $daily->id . '.png') }}" download
                                    class="mt-2 inline-block bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                    <i class="fas fa-download mr-1"></i> Download QR
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Tabel Pemeriksaan -->
                    <div class="overflow-x-auto relative">
                        <table class="min-w-full bg-white dark:bg-gray-900 rounded-lg shadow">
                            <thead class="bg-gray-200 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-2 text-left">Item Pemeriksaan</th>
                                    <th class="px-4 py-2 text-left">Kondisi</th>
                                    <th class="px-4 py-2 text-left">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($panel->formitems as $item)
                                    <tr class="border dark:border-gray-700">
                                        <td class="px-4 py-2">{{ $item->item_pemeriksaan }}</td>
                                        <td class="px-4 py-2">
                                            <!-- Pastikan $dailyChecklist tidak null sebelum mengakses items -->
                                            @if ($dailyChecklist)
                                                @php
                                                    $dailyItem = $dailyChecklist->items->firstWhere(
                                                        'form_checklist_item_id',
                                                        $item->id,
                                                    );
                                                @endphp
                                                @if ($dailyItem)
                                                    <span
                                                        class="font-semibold">{{ ucfirst($dailyItem->kondisi) }}</span>
                                                @else
                                                    <span class="text-gray-500">Belum diperiksa</span>
                                                @endif
                                            @else
                                                <span class="text-gray-500">Belum diperiksa</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 truncate-text"
                                            title="{{ Str::limit($item->keterangan, 100) }}">
                                            @if ($dailyChecklist)
                                                @php
                                                    $dailyItem = $dailyChecklist->items->firstWhere(
                                                        'form_checklist_item_id',
                                                        $item->id,
                                                    );
                                                @endphp
                                                @if ($dailyItem)
                                                    <span>{{ $dailyItem->keterangan ?? '-' }}</span>
                                                @else
                                                    <span class="text-gray-500">Belum diperiksa</span>
                                                @endif
                                            @else
                                                <span class="text-gray-500">Belum diperiksa</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('laporanHarian') }}"
                            class="bg-red-500 text-white px-4 py-2 rounded mt-4 hover:bg-red-600">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali
                        </a>
                        <a href="{{ route('laporanHarian.exportPdf', $panel->id) }}?tanggal={{ $selectedDate }}"
                            target="_blank"
                            class="bg-blue-500 text-white px-4 py-2 rounded ml-2 hover:bg-blue-600">
                            <i class="fas fa-file-pdf mr-1"></i> Export PDF
                         </a>                         
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
