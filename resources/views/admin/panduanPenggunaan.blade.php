<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Panduan Penggunaan
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl text-center font-semibold mb-2">Bagaimana cara mengelola data pemeriksaan harian?</h1>
                    <p class="text-center mb-12">Berikut adalah cara mengelola data pemeriksaan item harian.</p>
                    <h3 class="text-xl font-semibold mb-4">1. Menambahkan Data</h3>
                    <p>Untuk menambahkan data checklist harian, klik tombol <strong>"Buat Pemeriksaan Hari Ini"</strong>.</p>
                    <img src="{{ asset('images/tutorial/1-menambahkan-data.png') }}" alt="Tambah Data Checklist" class="rounded-lg shadow-lg my-4">
                    <p>Di halaman berikut, pilih Panel yang akan diperiksa dan masukkan tanggal.</p>
                    <img src="{{ asset('images/tutorial/2-menambahkan-data.png') }}" alt="Tambah Data Checklist" class="rounded-lg shadow-lg my-4">
                    <p>Setelah selesai, klik tombol <strong>"Simpan"</strong> untuk menyimpan data.</p>

                    <h3 class="text-xl font-semibold mt-6 mb-4">2. Mengedit Data</h3>
                    <p>Pilih data yang akan diedit, lalu klik tombol <strong>"Periksa"</strong>.</p>
                    <img src="{{ asset('images/tutorial/1-mengedit-data.png') }}" alt="Edit Data Checklist" class="rounded-lg shadow-lg my-4">
                    <p>Di halaman berikut, anda dapat menginput kondisi Item Pemeriksaan dengan value <strong>Baik</strong> atau <strong>Tidak Baik</strong>.</p>
                    <img src="{{ asset('images/tutorial/2-mengedit-data.png') }}" alt="Edit Data Checklist" class="rounded-lg shadow-lg my-4">
                    <p>Klik <strong>"Simpan Perubahan"</strong> setelah Anda menginput kondisi item. Data otomatis akan tersimpan di Tabel Harian.</p>
                    <img src="{{ asset('images/tutorial/1-tampilan-tabel.png') }}" alt="Tabel" class="rounded-lg shadow-lg my-4">

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
