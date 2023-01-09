<div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
    <div class="grid grid-cols-1 md:grid-cols-2 p-6">
        @foreach ($products as $product)
            <div class="p-6">{{ $product }}</div>
            <div class="p-6">prijs</div>
        @endforeach
    </div>
</div>
