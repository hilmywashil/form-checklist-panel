<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah Data Pemeriksaan Harian
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('formCheckDailyStore') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Panel</label>
                            <select name="form_checklist_panel_id" class="form-input w-full">
                                @foreach ($panels as $panel)
                                    <option value="{{ $panel->id }}">{{ $panel->nama_panel }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Tanggal</label>
                            <input type="date" name="tanggal" value="{{ now()->toDateString() }}" class="form-input w-full">
                        </div>

                        <button type="submit" class="btn btn-green">
                            <i class="fas fa-save mr-1"></i> Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
