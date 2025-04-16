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
                        <div>
                            <h1 class="text-2xl font-bold mb-2">CHECKLIST HARIAN</h1>
                            <h3 class="text-lg font-semibold">Nama Panel: <span
                                    class="font-normal">{{ $daily->panel->nama_panel }}</span></h3>
                            <h3 class="text-lg font-semibold">Teknisi: <span
                                    class="font-normal">{{ $daily->teknisi }}</span></h3>
                            <h3 class="text-lg font-semibold">Tanggal: <span
                                    class="font-normal">{{ \Carbon\Carbon::parse($daily->tanggal)->translatedFormat('l, d F Y') }}</span>
                            </h3>
                            <h3 class="text-lg font-semibold">Lokasi Panel: <span
                                    class="font-normal">{{ $daily->panel->lokasiRel->nama_lokasi }}</span></h3>
                        </div>

                        <div class="text-center -mr-14">
                            <img src="{{ asset('storage/qrcodes/ceklis_' . $daily->id . '.png') }}" alt="QR Code"
                                class="w-50 h-50 mx-auto">
                            <a href="{{ asset('storage/qrcodes/ceklis_' . $daily->id . '.png') }}" download
                                class="mt-2 inline-block bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                <i class="fas fa-download mr-1"></i> Download QR
                            </a>
                        </div>
                    </div>

                    <!-- Mulai Form -->
                    <form action="{{ route('formCheckDailyUpdate', $daily->id) }}" method="POST">
                        @csrf
                        @method('PUT')

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
                                    @if ($daily->items->isEmpty())
                                        <tr>
                                            <td colspan="3" class="text-center py-4 text-gray-500">
                                                Tidak ada item pemeriksaan yang tersedia di panel ini.
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($daily->items as $item)
                                            <tr class="border dark:border-gray-700">
                                                <td class="px-4 py-2">{{ $item->item->item_pemeriksaan }}</td>
                                                <td class="px-4 py-2">
                                                    <select name="kondisi[{{ $item->form_checklist_item_id }}]"
                                                        class="form-input w-full">
                                                        <option value=""
                                                            {{ $item->kondisi == null ? 'selected' : '' }}>Belum
                                                            diperiksa</option>
                                                        <option value="baik"
                                                            {{ $item->kondisi == 'baik' ? 'selected' : '' }}>Baik
                                                        </option>
                                                        <option value="tidak baik"
                                                            {{ $item->kondisi == 'tidak baik' ? 'selected' : '' }}>
                                                            Tidak Baik</option>
                                                    </select>
                                                </td>
                                                <td class="px-4 py-2 truncate-text"
                                                    title="{{ Str::limit($item->item->keterangan, 100) }}">
                                                    <input type="text"
                                                        name="keterangan[{{ $item->form_checklist_item_id }}]"
                                                        value="{{ $item->keterangan ?? '' }}"
                                                        class="form-input w-full">
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4 hover:bg-blue-600">
                            <i class="fas fa-save mr-1"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('adminChecklistDaily') }}"
                            class="bg-red-500 text-white px-4 py-2 rounded mt-4 hover:bg-red-600">
                            <i class="fas fa-arrow-left mr-1"></i>Kembali
                        </a>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>
</x-app-layout>
