<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            @yield('title')
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-600 dark:text-white overflow-hidden shadow-sm sm:rounded-lg p-3">
                @yield('content')
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
