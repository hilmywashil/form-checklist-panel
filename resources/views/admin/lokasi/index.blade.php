<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Daftar Admin
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('lokasiCreate') }}" class="btn btn-green">
                        <i class="fas fa-plus-circle mr-1"></i> TAMBAH LOKASI
                    </a>
                    <!-- Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                        @forelse ($lokasis as $item)
                            <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded-lg shadow-lg">
                                <h3 class="text-lg font-semibold">{{ $item->nama_lokasi }}</h3>
                                <p><i class="fa-solid fa-hard-drive"></i><strong> Jumlah Panel :
                                    </strong>{!! $item->formchecklistpanels->count() !!}
                                </p>
                                <div class="mt-3 flex space-x-2">
                                    <a href="{{ route('laporanHarian', ['lokasi' => $item->id]) }}" class="btn btn-dark">
                                        <i class="fas fa-eye mr-1"></i> DETAIL
                                    </a>
                                    @auth
                                        <a href="{{ route('lokasiEdit', $item->id) }}" class="btn btn-blue">
                                            <i class="fas fa-edit mr-1"></i> EDIT
                                        </a>
                                        <button type="button" class="btn btn-red delete-button"
                                            data-id="{{ $item->id }}">
                                            <i class="fas fa-trash-alt mr-1"></i> HAPUS
                                        </button>
                                        <form id="delete-form-{{ $item->id }}"
                                            action="{{ route('lokasiDelete', $item->id) }}" method="POST"
                                            class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @endauth
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-4">
                                <div class="alert alert-danger">
                                    <i class="fas fa-exclamation-triangle mr-1"></i> Data lokasi belum tersedia.
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Hapus Lokasi?',
                text: "Apakah Anda yakin ingin menghapus lokasi ini?",
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

        document.addEventListener("DOMContentLoaded", function() {
            const deleteButtons = document.querySelectorAll(".delete-button");

            deleteButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const id = this.getAttribute("data-id");

                    Swal.fire({
                        title: "Apakah Anda Yakin?",
                        text: "Data yang ada di Lokasi ini akan ikut terhapus!",
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

</x-app-layout>
