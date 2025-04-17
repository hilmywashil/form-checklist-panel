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

                    <!-- Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                        @forelse ($formpanels as $fp)
                            <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded-lg shadow-lg">
                                <h3 class="text-lg font-semibold">{{ $fp->nama_panel }}</h3>
                                <p><i class="fas fa-map-marker-alt mr-1"></i><strong> Lokasi :
                                    </strong>{!! $fp->lokasiRel->nama_lokasi !!}
                                </p>
                                <p><i class="fas fa-hashtag mr-1"></i><strong> Nomor SPK : </strong>{!! $fp->nomor_spk ?? '-' !!}
                                </p>
                                <div class="mt-3 flex space-x-2">
                                    <a href="{{ route('adminFormpanelShow', $fp->id) }}" class="btn btn-dark">
                                        <i class="fas fa-eye mr-1"></i> DETAIL
                                    </a>
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
