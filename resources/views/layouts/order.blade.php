<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @yield('title')
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="xl:w-[85%] mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg md:flex">
                <div class="xl:w-[70%] lg:w-[60%]">@yield('product-list')</div>
                <div class="xl:w-[30%] lg:w-[40%] bg-white m-5 rounded-md">@yield('shopping-cart')</div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
