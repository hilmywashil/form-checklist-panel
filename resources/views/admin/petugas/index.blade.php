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
                    <div class="mb-4 flex justify-start">
                        <a href="{{ route('adminCreate') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Tambah Admin
                        </a>
                    </div>
                    <table class="table-auto w-full bg-white dark:bg-gray-900 rounded-lg shadow text-center">
                        <thead class="bg-gray-200 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2">Nama</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Role</th>
                                <th class="px-4 py-2">Terdaftar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $admin)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-2">{{ $admin->name }}</td>
                                    <td class="px-4 py-2">{{ $admin->email }}</td>
                                    <td class="px-4 py-2">{{ ucfirst($admin->role) }}</td>
                                    <td class="px-4 py-2">{{ $admin->created_at->translatedFormat('F Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if ($users->isEmpty())
                        <p class="text-gray-500 dark:text-gray-400 text-center mt-4">Tidak ada admin yang terdaftar.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Hapus Admin?',
                text: "Apakah Anda yakin ingin menghapus admin ini?",
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
