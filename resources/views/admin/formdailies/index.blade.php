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

                    <div class="mb-4 flex justify-between items-center">
                        <a href="{{ route('formCheckDailyCreate') }}" class="btn btn-primary">
                            <i class="fas fa-plus-circle mr-1"></i> Tambah Pemeriksaan
                        </a>
                    </div>

                    @if ($checklists->isEmpty())
                        <div class="text-center py-6">
                            <p class="text-gray-500 dark:text-gray-400">Belum ada checklist harian.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 gap-6">
                            @foreach ($checklists->groupBy('tanggal') as $tanggal => $dailyChecklists)
                                @if (\Carbon\Carbon::parse($tanggal)->month == request('bulan') || !request('bulan'))
                                    <div class="bg-gray-100 dark:bg-gray-700 rounded-lg shadow p-4">
                                        <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200">
                                            {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}
                                        </h3>
                                        <div class="overflow-x-auto mt-3">
                                            <table
                                                class="table-auto w-full bg-white dark:bg-gray-900 rounded-lg shadow text-center">
                                                <thead class="bg-gray-200 dark:bg-gray-700">
                                                    <tr>
                                                        <th class="px-4 py-2">Panel</th>
                                                        <th class="px-4 py-2">Teknisi</th>
                                                        <th class="px-4 py-2">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($dailyChecklists as $checklist)
                                                        <tr class="border-b dark:border-gray-700">
                                                            <td class="px-4 py-2">{{ $checklist->panel->nama_panel }}
                                                            </td>
                                                            <td class="px-4 py-2">{{ $checklist->teknisi }}</td>
                                                            <td class="px-4 py-2">
                                                                <div class="flex justify-center gap-2">
                                                                    <a href="{{ route('formCheckDailyEdit', $checklist->id) }}"
                                                                        class="btn btn-blue">
                                                                        <i class="fas fa-edit mr-1"></i> Edit
                                                                    </a>
                                                                    <button
                                                                        onclick="confirmDelete({{ $checklist->id }})"
                                                                        class="btn btn-red">
                                                                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                                                                    </button>
                                                                    <form id="delete-form-{{ $checklist->id }}"
                                                                        action="{{ route('formCheckDailyDestroy', $checklist->id) }}"
                                                                        method="POST" style="display: none;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: true,
                confirmButtonText: 'Oke, Lanjut!',
                timer: 2000
            });
        @endif

        function confirmDelete(id) {
            Swal.fire({
                title: 'Hapus Checklist?',
                text: "Apakah Anda yakin ingin menghapus checklist ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
</x-app-layout>
