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

                    <form action="{{ route('adminFormpanels') }}" method="GET" class="mt-4 mb-12">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-end">
                            <div>
                                <select name="lokasi" id="lokasi" class="form-select w-full"
                                    onchange="this.form.submit()">
                                    <option value="" disabled selected>Pilih Lokasi</option>
                                    @foreach ($lokasis as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ request('lokasi') == $key ? 'selected' : '' }}>
                                            {{ $value }}
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

                    <!-- Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                        <a href="{{ route('formpanelCreate') }}" class="bg-green-500 dark:bg-green-600 p-4 rounded-lg flex items-center justify-center flex-col text-white gap-4 text-xl">
                            <i class="fa-solid fa-plus fa-2xl"></i> TAMBAH PANEL
                        </a>
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
                                    <a href="{{ route('formpanelCopy', $fp->id) }}" class="btn btn-warning">
                                        <i class="fas fa-copy mr-1"></i> SALIN
                                    </a>
                                    @auth
                                        <a href="{{ route('formpanelEdit', $fp->id) }}" class="btn btn-blue">
                                            <i class="fas fa-edit mr-1"></i> EDIT
                                        </a>
                                        <button type="button" class="btn btn-red delete-button" data-id="{{ $fp->id }}">
                                            <i class="fas fa-trash-alt mr-1"></i> HAPUS
                                        </button>
                                        <form id="delete-form-{{ $fp->id }}" action="{{ route('formpanelDelete', $fp->id) }}"
                                            method="POST" class="hidden">
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
            document.addEventListener("DOMContentLoaded", function () {
                const deleteButtons = document.querySelectorAll(".delete-button");

                deleteButtons.forEach(button => {
                    button.addEventListener("click", function () {
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