<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pemeriksaan Harian Panel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Tombol Tambah Pemeriksaan -->
                    <a href="{{ route('formCheckDailyCreate') }}" class="btn btn-green">
                        <i class="fas fa-plus-circle mr-1"></i> TAMBAH PEMERIKSAAN
                    </a>

                    <!-- Form Filter -->
                    <form action="{{ route('adminFormDaily') }}" method="GET" class="mt-4">
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label for="panel" class="block text-sm font-medium">
                                    <i class="fas fa-tools mr-1"></i> Filter Nama Panel
                                </label>
                                <input type="text" name="panel" id="panel" value="{{ request('panel') }}"
                                    class="form-input w-full" placeholder="Masukkan nama panel...">
                            </div>
                            <div>
                                <label for="bulan" class="block text-sm font-medium">
                                    <i class="fas fa-calendar mr-1"></i> Bulan Pemeriksaan
                                </label>
                                <select name="bulan" id="bulan" class="form-input w-full" onchange="this.form.submit()">
                                    <option value="">Semua</option>
                                    @foreach (range(1, 12) as $bln)
                                        <option value="{{ $bln }}"
                                            {{ request('bulan') == $bln ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::create()->month($bln)->translatedFormat('F') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex items-end space-x-2">
                                <button type="submit" class="btn btn-blue">
                                    <i class="fas fa-filter mr-1"></i> Filter
                                </button>
                                <a href="{{ route('adminFormDaily') }}" class="btn btn-gray">
                                    <i class="fas fa-sync-alt mr-1"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>

                    <!-- Kartu Checklist -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                        @forelse ($checklists as $checklist)
                            <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded-lg shadow-lg">
                                <h3 class="text-lg font-semibold">{{ $checklist->panel->nama_panel }}</h3>
                                <p><i class="fas fa-calendar mr-1"></i> {{ \Carbon\Carbon::parse($checklist->tanggal)->translatedFormat('l, d F Y') }}</p>
                                <p><i class="fas fa-user mr-1"></i> Teknisi: {{ $checklist->teknisi }}</p>
                                <div class="mt-3 flex space-x-2">
                                    <a href="{{ route('formCheckDailyEdit', $checklist->id) }}" class="btn btn-blue">
                                        <i class="fas fa-edit mr-1"></i> EDIT
                                    </a>
                                    <button type="button" class="btn btn-red delete-button" data-id="{{ $checklist->id }}">
                                        <i class="fas fa-trash-alt mr-1"></i> HAPUS
                                    </button>
                                    <form id="delete-form-{{ $checklist->id }}" action="{{ route('formCheckDailyDestroy', $checklist->id) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-4">
                                <div class="alert alert-danger">
                                    <i class="fas fa-exclamation-triangle mr-1"></i> Tidak ada data pemeriksaan.
                                </div>
                            </div>
                        @endforelse
                    </div>

                    {{ $checklists->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                document.querySelectorAll(".delete-button").forEach(button => {
                    button.addEventListener("click", function () {
                        const id = this.getAttribute("data-id");

                        Swal.fire({
                            title: "Hapus Data?",
                            text: "Data ini akan dihapus permanen!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#d33",
                            cancelButtonColor: "#3085d6",
                            confirmButtonText: "Ya, Hapus!",
                            cancelButtonText: "Batal"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById(`delete-form-${id}`).submit();
                            }
                        });
                    });
                });

                @if (session('success'))
                    Swal.fire({
                        title: "Berhasil!",
                        text: "{{ session('success') }}",
                        icon: "success",
                        confirmButtonColor: "#3085d6"
                    });
                @endif
            });
        </script>
    @endpush
</x-app-layout>
