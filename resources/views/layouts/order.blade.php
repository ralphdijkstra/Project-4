<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            @yield('title')
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="xl:w-[85%] mx-auto sm:px-6 lg:px-8">
            @if (session()->has('success'))
                <div class="py-3 text-center w-[50%] mx-auto text-green-500 bg-green-200 rounded-md">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="overflow-hidden shadow-sm sm:rounded-lg md:flex dark:bg-slate-700">
                <div class="xl:w-[70%] lg:w-[60%]">@yield('product-list')</div>
                <div class="xl:w-[30%] lg:w-[40%] bg-white dark:bg-slate-600 m-5 rounded-md p-3">@yield('shopping-cart')</div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
