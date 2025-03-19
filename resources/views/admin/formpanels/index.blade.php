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
                    <a href="{{ route('formpanelCreate') }}" class="btn btn-green">
                        <i class="fas fa-plus-circle mr-1"></i> TAMBAH PANEL
                    </a>

                    <!-- Form Filter Tanggal -->
                    <form action="{{ route('adminFormpanels') }}" method="GET" class="mt-4">
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
                                <a href="{{ route('adminFormpanels') }}" class="btn btn-gray">
                                    <i class="fas fa-sync-alt mr-1"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>

                    <!-- Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                        @forelse ($formpanels as $fp)
                            <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded-lg shadow-lg">
                                <h3 class="text-lg font-semibold">{{ $fp->nama_panel }}</h3>
                                <p><i class="fas fa-map-marker-alt mr-1"></i><strong> Lokasi : </strong>{!! $fp->lokasi !!}</p>
                                <p><i class="fas fa-calendar mr-1"></i><strong> Tanggal : </strong>{!! $fp->tanggal !!}</p>
                                <p><i class="fas fa-user mr-1"></i><strong> Teknisi : </strong>{!! $fp->teknisi !!}</p>
                                <div class="mt-3 flex space-x-2">
                                    <a href="{{ route('adminFormpanelShow', $fp->id) }}" class="btn btn-dark">
                                        <i class="fas fa-eye mr-1"></i> DETAIL
                                    </a>
                                    @auth
                                        <a href="{{ route('formpanelEdit', $fp->id) }}" class="btn btn-blue">
                                            <i class="fas fa-edit mr-1"></i> EDIT
                                        </a>
                                        <button type="button" class="btn btn-red delete-button" data-id="{{ $fp->id }}">
                                            <i class="fas fa-trash-alt mr-1"></i> HAPUS
                                        </button>
                                        <form id="delete-form-{{ $fp->id }}" action="{{ route('formpanelDelete', $fp->id) }}" method="POST" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @endauth
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-4">
                                <div class="alert alert-danger">
                                    <i class="fas fa-exclamation-triangle mr-1"></i> Data Form Panel belum tersedia.
                                </div>
                            </div>
                        @endforelse
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
                        confirmButtonText: "Oke, Lanjut"
                    });
                @elseif (session()->has('error'))
                    Swal.fire({
                        title: "Gagal!",
                        text: "{{ session('error') }}",
                        icon: "error",
                        confirmButtonColor: "#d33",
                        confirmButtonText: "Oke, Mengerti"
                    });
                @endif
            });
        </script>
    @endpush
</x-app-layout>