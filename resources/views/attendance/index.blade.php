<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kehadiran') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-12">
        <h2 class="text-2xl font-semibold mb-4">Absensi Karyawan Bulan Ini</h2>

        <form method="POST" action="{{ route('attendance.store') }}" id="attendanceForm">
            @csrf
            <div class="mb-4">
                <input type="text" name="employee_name" placeholder="Masukkan Nama Karyawan"
                    class="border px-4 py-2 rounded-md w-1/2" required>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Absen
                </button>
            </div>

            <table class="table-auto w-full border-collapse border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2">No.</th>
                        <th class="border px-4 py-2">Nama Karyawan</th>
                        @for ($day = 1; $day <= $daysInMonth; $day++)
                            <th class="border px-2 py-1">{{ $day }}</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendances as $employee_name => $records)
                        <tr>
                            <td class="border px-4 py-2 text-center">{{ $loop->index + 1 }}.</td>
                            <td class="border px-4 py-2">{{ ucwords($employee_name) }}</td>
                            @for ($day = 1; $day <= $daysInMonth; $day++)
                                @php
                                    $date = now()->format('Y-m') . '-' . str_pad($day, 2, '0', STR_PAD_LEFT);
                                    $isPresent = $records->where('date', $date)->first();
                                @endphp
                                <td class="border px-2 py-1 text-center">
                                    <input type="checkbox" name="attendance[{{ $date }}]" value="1"
                                        {{ $isPresent ? 'checked' : '' }} disabled>
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('attendanceForm').addEventListener('submit', function(event) {
            event.preventDefault();
            let form = this;
            Swal.fire({
                title: "Berhasil!",
                text: "Absensi berhasil dicatat!",
                icon: "success",
                showConfirmButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Oke, lanjut"
            }).then(() => {
                form.submit();
            });
        });
    </script>

</x-app-layout>
