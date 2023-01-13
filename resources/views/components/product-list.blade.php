<div class="bg-white overflow-hidden shadow sm:rounded-lg">
    <div class="grid grid-cols-1 md:grid-cols-3 p-6">
        @foreach ($products as $product)
            <div class="p-6">{{ $product->name }}</div>
            <div class="p-6">${{ $product->price }}</div>
            <div class="p-6"><a href="{{ route('product.addtocart', [$product->id]) }}" class="underline">Add to cart</a></div>
        @endforeach
    </div>
</div>
