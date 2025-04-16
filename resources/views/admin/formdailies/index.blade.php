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

                    {{-- <a href="{{ route('formCheckDailyCreate') }}" class="btn btn-green">
                        <i class="fas fa-plus-circle mr-1"></i> TAMBAH PEMERIKSAAN
                    </a> --}}

                    <form action="{{ route('adminFormDaily') }}" method="GET" class="mt-4 mb-12">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-end">
                            <div>
                                <select name="lokasi" id="lokasi" class="form-select w-full"
                                    onchange="this.form.submit()">
                                    <option value="" disabled selected>Pilih Lokasi</option>
                                    @foreach ($lokasis as $lokasi)
                                        <option value="{{ $lokasi->id }}"
                                            {{ request('lokasi') == $lokasi->id ? 'selected' : '' }}>
                                            {{ $lokasi->nama_lokasi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('adminFormDaily') }}" class="btn btn-gray">
                                    <i class="fas fa-sync-alt mr-1"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>

                    @if (request()->filled('lokasi'))
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
                            @foreach ($panels as $panel)
                                @php
                                    $todayCheck = $panel->checklists
                                        ->where('tanggal', today()->toDateString())
                                        ->first();
                                @endphp

                                <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded-lg shadow-lg">
                                    <h3 class="text-lg font-semibold">{{ $panel->nama_panel }}</h3>
                                    <p><i class="fas fa-map-marker-alt mr-1"></i> Lokasi:
                                        {{ $panel->lokasiRel->nama_lokasi }}</p>
                                    @if ($todayCheck)
                                        <p><i class="fas fa-check-circle text-green-500 mr-1"></i>
                                            Sudah ada pemeriksaan hari ini</p>
                                    @else
                                        <p><i class="fas fa-times-circle text-red-500 mr-1"></i>
                                            Belum ada pemeriksaan hari ini</p>
                                    @endif

                                    <div class="mt-3 flex space-x-2">
                                        @if ($todayCheck)
                                            <a href="{{ route('formCheckDailyEdit', $todayCheck->id) }}"
                                                class="btn btn-dark">
                                                <i class="fas fa-eye mr-1"></i> Periksa
                                            </a>
                                        @else
                                            <form action="{{ route('formCheckDailyQuickCreate', $panel->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-green">
                                                    <i class="fas fa-plus-circle mr-1"></i> Buat Pemeriksaan di Panel
                                                    Ini
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="mt-6 text-center text-gray-500">
                            <i class="fas fa-search-location text-xl mb-2"></i>
                            <p>Silakan masukkan lokasi untuk melihat daftar panel yang diperiksa.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll(".delete-button").forEach(button => {
                    button.addEventListener("click", function() {
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
                @elseif (session('error'))
                    Swal.fire({
                        title: "Gagal!",
                        text: "{{ session('error') }}",
                        icon: "error",
                        confirmButtonColor: "#3085d6"
                    });
                @endif
            });
        </script>
    @endpush
</x-app-layout>
