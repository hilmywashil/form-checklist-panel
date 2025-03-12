<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Checklist Harian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @foreach ($panels as $panel)
                <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-6 py-4 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100 font-semibold">
                        <h5>{{ $panel->nama_panel }}</h5>
                    </div>
                    <div class="p-6">
                        <ul class="list-group">
                            @foreach ($panel->checklists as $checklist)
                                <li class="list-group-item d-flex justify-between items-center">
                                    <span>{{ $checklist->item_pemeriksaan }}</span>
                                    <input type="checkbox" class="update-status" data-id="{{ $checklist->id }}"
                                        {{ $checklist->status ? 'checked' : '' }}>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).on('change', '.update-status', function() {
                let id = $(this).data('id');
                $.ajax({
                    url: '/checklist-daily/' + id,
                    type: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log('Checklist updated');
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
