<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Form Panel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="mb-6 flex justify-between items-start">
                        <div>
                            <h1><strong>Form {{ $formpanel->nama_panel }}</strong></h1>
                            <p><strong><i class="fas fa-map-marker-alt"></i> Lokasi:</strong> {{ $formpanel->lokasi }}
                            </p>
                            <p><strong><i class="fas fa-calendar-alt"></i> Tanggal:</strong> {{ $formpanel->tanggal }}
                            </p>
                            <p><strong><i class="fas fa-user"></i> Teknisi:</strong> {{ $formpanel->teknisi }}</p>
                        </div>
                        <div class="text-center">
                            <img id="qrCode" src="{{ asset('storage/qrcodes/panel_' . $formpanel->id . '.png') }}"
                                alt="QR Code" class="w-32 h-32">
                            <a id="downloadQR" href="{{ asset('storage/qrcodes/panel_' . $formpanel->id . '.png') }}"
                                download="{{ $formpanel->nama_panel }}.png" class="btn btn-blue mt-2">
                                <i class="fas fa-download"></i> Download
                            </a>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full border border-gray-300 rounded-lg">
                            <thead class="bg-gray-700 text-white">
                                <tr>
                                    <th class="border px-4 py-2">No</th>
                                    <th class="border px-4 py-2"><i class="fas fa-tasks"></i> ITEM PEMERIKSAAN</th>
                                    <th class="border px-4 py-2"><i class="fas fa-check-circle"></i> KONDISI</th>
                                    <th class="border px-4 py-2"><i class="fas fa-info-circle"></i> KETERANGAN</th>
                                    <th class="border px-4 py-2"><i class="fas fa-cogs"></i> AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($formitems as $index => $fi)
                                    <tr class="text-left bg-gray-100">
                                        <td class="border px-4 py-2">{{ $index + 1 }}</td>
                                        <td class="border px-4 py-2">{{ $fi->item_pemeriksaan }}</td>
                                        <td class="border px-4 py-2">
                                            <div class="flex justify-center gap-2">
                                                <button
                                                    class="btn {{ $fi->check == 'normal' ? 'btn-green' : 'btn-gray' }}"
                                                    onclick="updateCheck({{ $fi->id }}, 'normal')">
                                                    <i class="fas fa-check"></i> Normal
                                                </button>
                                                <button
                                                    class="btn {{ $fi->check == 'perbaikan' ? 'btn-red' : 'btn-gray' }}"
                                                    onclick="updateCheck({{ $fi->id }}, 'perbaikan')">
                                                    <i class="fas fa-tools"></i> Perbaikan
                                                </button>
                                            </div>
                                        </td>
                                        <td class="border px-4 py-2 truncate-text" title="{{ $fi->keterangan }}">
                                            {{ Str::limit($fi->keterangan, 50, '...') }}
                                            @if (!$fi->keterangan)
                                                <a href="{{ route('formitemEdit', $fi->id) }}" class="text-blue-500">+
                                                    Tambah Keterangan</a>
                                            @endif
                                        </td>
                                        <td class="border px-4 py-2 flex items-center justify-center gap-2">
                                            <a href="{{ route('formitemEdit', $fi->id) }}" class="btn btn-blue">
                                                <i class="fas fa-edit"></i> EDIT
                                            </a>
                                            <button type="button" class="btn btn-red delete-button"
                                                data-id="{{ $fi->id }}">
                                                <i class="fas fa-trash"></i> HAPUS
                                            </button>
                                            <form id="delete-form-{{ $fi->id }}"
                                                action="{{ route('formitemDelete', $fi->id) }}" method="POST"
                                                class="hidden">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="border text-center py-4">
                                            <div class="text-red-500 font-semibold">
                                                <i class="fas fa-exclamation-triangle"></i> Data Form Item belum
                                                tersedia.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $formitems->links() }}
                    </div>

                    <!-- Buttons -->
                    <div class="mt-6 flex justify-between">
                        <a href="{{ route('adminFormpanels') }}" class="btn btn-red">
                            <i class="fas fa-arrow-left"></i> KEMBALI
                        </a>
                        <div class="flex gap-3">
                            <a href="{{ route('formpanels.pdf', $formpanel->id) }}" class="btn btn-blue">
                                <i class="fas fa-file-pdf"></i> DOWNLOAD PDF
                            </a>
                            @auth
                                <a href="{{ route('formitemCreate', ['panel_id' => $formpanel->id]) }}"
                                    class="btn btn-green">
                                    <i class="fas fa-plus"></i> TAMBAH DATA
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const deleteButtons = document.querySelectorAll(".delete-button");

                deleteButtons.forEach(button => {
                    button.addEventListener("click", function() {
                        const id = this.getAttribute("data-id");

                        Swal.fire({
                            title: "Apakah Anda Yakin?",
                            text: "Data yang dihapus tidak dapat dikembalikan!",
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

            function updateCheck(itemId, value) {
                fetch(`/admin/formitem/update-check/${itemId}`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            check: value
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // if (data.success) {
                        //     location.reload();
                        // } else {
                        //     Swal.fire("Gagal!", "Terjadi kesalahan!", "error");
                        // }
                        if (data.success) {
                            Swal.fire({
                                title: "Berhasil!",
                                text: "Kondisi berhasil diperbarui!",
                                icon: "success",
                                confirmButtonColor: "#3085d6",
                                confirmButtonText: "Oke, Lanjut"
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: "Gagal!",
                                text: "Terjadi kesalahan!",
                                icon: "error",
                                confirmButtonColor: "#d33",
                                confirmButtonText: "Oke, Mengerti"
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire("Gagal!", "Terjadi kesalahan saat memperbarui!", "error");
                    });
            }
        </script>
    @endpush
</x-app-layout>
