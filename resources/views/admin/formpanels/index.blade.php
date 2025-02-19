<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Form Panel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Button Tambah Panel -->
                    <a href="{{ route('formpanels.create') }}" class="btn btn-green">
                        <i class="fas fa-plus-circle mr-1"></i> TAMBAH PANEL
                    </a>

                    <!-- Form Filter Tanggal -->
                    <form action="{{ route('formpanels.index') }}" method="GET" class="mt-4">
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label for="start_date" class="block text-sm font-medium">
                                    <i class="fas fa-calendar-alt mr-1"></i> Filter dari Tanggal
                                </label>
                                <input type="date" class="form-input w-full" id="start_date" name="start_date"
                                    value="{{ request('start_date') }}">
                            </div>
                            <div>
                                <label for="end_date" class="block text-sm font-medium">
                                    <i class="fas fa-calendar-check mr-1"></i> Sampai Tanggal
                                </label>
                                <input type="date" class="form-input w-full" id="end_date" name="end_date"
                                    value="{{ request('end_date') }}">
                            </div>
                            <div class="flex items-end space-x-2">
                                <button type="submit" class="btn btn-blue">
                                    <i class="fas fa-filter mr-1"></i> Filter
                                </button>
                                <a href="{{ route('formpanels.index') }}" class="btn btn-gray">
                                    <i class="fas fa-sync-alt mr-1"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>

                    <!-- Table -->
                    <div class="overflow-x-auto mt-4">
                        <table class="table-auto w-full border-collapse border">
                            <thead class="bg-gray-700 text-white">
                                <tr>
                                    <th class="border px-4 py-2"><i class="fas fa-th-list"></i> NAMA PANEL</th>
                                    <th class="border px-4 py-2"><i class="fas fa-map-marker-alt"></i> LOKASI</th>
                                    <th class="border px-4 py-2"><i class="fas fa-calendar"></i> TANGGAL</th>
                                    <th class="border px-4 py-2"><i class="fas fa-user"></i> TEKNISI</th>
                                    <th class="border px-4 py-2"><i class="fas fa-info-circle"></i> DETAIL</th>
                                    <th class="border px-4 py-2"><i class="fas fa-tools"></i> ADMIN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($formpanels as $fp)
                                    <tr class="text-center bg-gray-100">
                                        <td class="border px-4 py-2">{{ $fp->nama_panel }}</td>
                                        <td class="border px-4 py-2">{!! $fp->lokasi !!}</td>
                                        <td class="border px-4 py-2">{!! $fp->tanggal !!}</td>
                                        <td class="border px-4 py-2">{!! $fp->teknisi !!}</td>
                                        <td class="border px-4 py-2">
                                            <a href="{{ route('formpanels.show', $fp->id) }}" class="btn btn-black">
                                                <i class="fas fa-eye mr-1"></i> DETAIL </a>
                                        </td>
                                        <td class="border px-4 py-2">
                                            <a href="{{ route('formpanels.edit', $fp->id) }}" class="btn btn-blue">
                                                <i class="fas fa-edit mr-1"></i> EDIT
                                            </a>
                                            <button type="button" class="btn btn-red delete-button"
                                                data-id="{{ $fp->id }}">
                                                <i class="fas fa-trash-alt mr-1"></i> HAPUS
                                            </button>
                                            <form id="delete-form-{{ $fp->id }}"
                                                action="{{ route('formpanels.destroy', $fp->id) }}" method="POST"
                                                class="hidden">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="border text-center py-4">
                                            <div class="alert alert-danger">
                                                <i class="fas fa-exclamation-triangle mr-1"></i> Data Form Panel belum
                                                tersedia.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $formpanels->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const deleteButtons = document.querySelectorAll(".delete-button");

                deleteButtons.forEach(button => {
                    button.addEventListener("click", function() {
                        const id = this.getAttribute("data-id");

                        Swal.fire({
                            title: "Apakah Anda Yakin?",
                            text: "Data yang ada di Panel ini akan ikut terhapus!",
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

                @if (session()->has('success'))
                    Swal.fire({
                        title: "Berhasil!",
                        text: "{{ session('success') }}",
                        icon: "success",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK"
                    });
                @elseif (session()->has('error'))
                    Swal.fire({
                        title: "Gagal!",
                        text: "{{ session('error') }}",
                        icon: "error",
                        confirmButtonColor: "#d33",
                        confirmButtonText: "OK"
                    });
                @endif
            });
        </script>
    @endpush
</x-app-layout>
