<x-app-layout>
    <div class="flex flex-col items-center justify-center min-h-screen px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-red-600">Akses Ditolak</h1>
        <p class="mt-4 text-lg text-gray-600 max-w-md">Anda tidak memiliki izin untuk mengakses halaman ini.</p>
        <a href="{{ route('dashboard') }}"
            class="mt-6 inline-block px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
            Kembali ke Dashboard
        </a>
    </div>
</x-app-layout>
