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

                    <!-- Informasi Panel & QR Code -->
                    <div class="flex justify-between items-start mb-6">
                        <!-- Informasi Panel -->
                        <div>
                            <h1 class="text-2xl font-bold mb-2">CHECKLIST HARIAN</h1>
                            <h3 class="text-lg font-semibold">Nama Panel: <span
                                    class="font-normal">{{ $daily->panel->nama_panel }}</span></h3>
                            <h3 class="text-lg font-semibold">Teknisi: <span
                                    class="font-normal">{{ $daily->teknisi }}</span></h3>
                            <h3 class="text-lg font-semibold">Tanggal: <span
                                    class="font-normal">{{ \Carbon\Carbon::parse($daily->tanggal)->translatedFormat('l, d F Y') }}</span></h3>
                        </div>

                        <!-- QR Code dan tombol download -->
                        <div class="text-center -mr-14">
                            <img src="{{ asset('storage/qrcodes/ceklis_' . $daily->id . '.png') }}" alt="QR Code"
                                class="w-50 h-50 mx-auto ">
                            <a href="{{ asset('storage/qrcodes/ceklis_' . $daily->id . '.png') }}" download
                                class="mt-2 inline-block bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                <i class="fas fa-download mr-1"></i> Download QR
                            </a>
                        </div>
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
                                @foreach ($daily->items as $item)
                                    <tr class="border dark:border-gray-700">
                                        <td class="px-4 py-2">{{ $item->item->item_pemeriksaan }}</td>
                                        <td class="px-4 py-2">
                                            <select name="kondisi[{{ $item->form_checklist_item_id ?? 'default_id' }}]"
                                                class="form-input w-full">
                                                <option value="" {{ $item->kondisi == null ? 'selected' : '' }}>Belum
                                                    diperiksa
                                                </option>
                                                <option value="baik" {{ $item->kondisi == 'baik' ? 'selected' : '' }}>Baik
                                                </option>
                                                <option value="tidak baik" {{ $item->kondisi == 'tidak baik' ? 'selected' : '' }}>Tidak
                                                    Baik</option>
                                            </select>
                                        </td>
                                        <td class="px-4 py-2 truncate-text"
                                            title="{{ Str::limit($item->item->keterangan, 100) }}">
                                            <input type="text" name="keterangan[{{ $item->form_checklist_item_id }}]"
                                                value="{{ $item->keterangan ?? '' }}" class="form-input w-full">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Tombol Simpan -->
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4 hover:bg-blue-600">
                        <i class="fas fa-save mr-1"></i> Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>