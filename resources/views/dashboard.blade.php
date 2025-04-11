<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-3">👋 Selamat datang, {{ Auth::user()->name }}!</h3>
                    <p class="mb-3">Klik "Get Started" dibawah untuk melihat Panduan Penggunaan.</p>
                    <div class="flex gap-3">
                        <a href="{{ route('tutorial') }}" class="btn btn-blue">
                            Get Started
                        </a>
                    </div>
                </div>
            </div>
            <div class="text-center font-semibold mt-4 text-xl">Main Menu</div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                <!-- Card 1 -->
                <a href="{{ route('adminFormpanels') }}"
                    class="block p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-edit text-3xl text-blue-500"></i>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Daftar Form Panel</h4>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Kelola data Form Panel.</p>
                        </div>
                    </div>
                </a>

                <!-- Card 2 -->
                <a href="{{ route('dailyTableCheck') }}"
                    class="block p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-table text-3xl text-green-500"></i>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Tabel Harian</h4>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Cek Kondisi Item setiap hari.</p>
                        </div>
                    </div>
                </a>

                <!-- Card 3 -->
                <a href="{{ route('adminFormDaily') }}"
                    class="block p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-window-restore text-3xl text-green-500"></i>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Data Pemeriksaan Harian
                            </h4>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Tambah pemeriksaan item hari ini.</p>
                        </div>
                    </div>
                </a>

                <!-- Monitoring Card 1 -->
                <a href="{{ route('adminFormpanels') }}"
                    class="block p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-clipboard-list text-3xl text-purple-500"></i>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Jumlah Form Panel</h4>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">
                                <strong>{{ $formpanelcount ?? 0 }}</strong> Form Panel
                            </p>
                        </div>
                    </div>
                </a>

                <!-- Monitoring Card 2 -->
                <a href="{{ route('adminFormDaily') }}"
                    class="block p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-list text-3xl text-orange-500"></i>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Jumlah Data Harian</h4>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">
                                <strong>{{ $totalformdaily ?? 0 }}</strong> Data
                            </p>
                        </div>
                    </div>
                </a>

                <!-- Monitoring Card 3 -->
                <a href="{{ route('adminList') }}" class="block p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-user text-3xl text-red-500"></i>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Jumlah Petugas Aktif</h4>
                            <p class="text-gray-600 dark:text-gray-400 text-sm"><strong>{{ $totalUsers ?? 0 }}</strong>
                                Admin</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
