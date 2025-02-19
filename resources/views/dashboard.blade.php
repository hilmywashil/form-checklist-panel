<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-4">👋 Selamat datang, Admin!</h3>
                    {{ __("Klik menu dibawah untuk melanjutkan.") }}
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <!-- Card 1 -->
                <a href="/formpanels" class="block p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-lg transition">
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-edit text-3xl text-blue-500"></i>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Form Panels</h4>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Kelola form panel dengan mudah.</p>
                        </div>
                    </div>
                </a>

                <!-- Card 2 -->
                <a href="#" class="block p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-lg transition">
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-cogs text-3xl text-green-500"></i>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Fitur Lain</h4>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Fitur ini akan segera hadir.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
