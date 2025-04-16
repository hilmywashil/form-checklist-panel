<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Laporan Harian
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <form method="GET" action="{{ route('laporanHarian') }}">
                    <div class="mb-4">
                        <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">Pilih Lokasi:</label>
                        <select name="lokasi" id="lokasi" onchange="this.form.submit()"
                            class="block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">
                            <option value="" disabled selected>Pilih Lokasi</option>
                            @foreach ($lokasis as $lokasi)
                                <option value="{{ $lokasi->id }}"
                                    {{ request('lokasi') == $lokasi->id ? 'selected' : '' }}>
                                    {{ $lokasi->nama_lokasi }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>

                @if ($panels->isNotEmpty())
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Panel di Lokasi:</h3>
                    <ul class="space-y-2">
                        @foreach ($panels as $panel)
                            <li>
                                <a href="{{ route('laporanHarianDetail', $panel->id) }}"
                                    class="block px-4 py-2 bg-indigo-100 hover:bg-indigo-200 text-indigo-800 rounded-md transition">
                                    {{ $panel->nama_panel }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
