<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Halaman Tidak Ditemukan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                <img style="width: 500px" src="{{ asset('images/404.jpg') }}" alt="Not Found" class="mx-auto my-6 w-64">
                <p class="mt-4 text-lg text-gray-700 dark:text-gray-300">
                    Oops! Halaman yang Anda cari tidak ditemukan.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
