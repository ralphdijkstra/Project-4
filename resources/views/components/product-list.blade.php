{{-- <div class="p-6">
    <div class="flex font-bold text-xl">Products</div>
        @foreach ($products as $product)
            <form action="{{ route('cart.add', [$product->id]) }}">
                <div class="grid grid-cols-1 md:grid-cols-5">
                    <div class="py-6 flex items-center">{{ $product->name }}</div>
                    <div class="py-6 flex items-center">€ {{ number_format($product->price, 2) }}</div>
                    <div class="py-6 flex items-center">
                        <select name="size" id="size">
                            <option value="25">(25 cm) Small -€ 1,50</option>
                            <option value="29" selected>(29 cm) Medium</option>
                            <option value="35">(35 cm) Large +€ 1,50</option>
                            <option value="40">(40 cm) XXL +€ 3,00</option>
                        </select>
                    </div>
                    <div class="py-6 flex items-center">
                        <select class="w-full" name="ingredients[]" id="ingredients" multiple>
                            @foreach ($ingredients as $ingredient)
                                <option value="{{ $ingredient->id }}" @if ($product->ingredients->contains($ingredient)) selected @endif >{{ $ingredient->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="py-6 flex items-center"><input type="submit" value="Add to cart" class="btn m-6 h-10"></div>
                    
            </form>
    </div>
    @endforeach
</div> --}}

<div class="p-6">
    <div class="grid 2xl:grid-cols-4 xl:grid-cols-3 grid-cols-2">
        @foreach ($products as $product)
            <div class="bg-white m-5 rounded-md p-1">
                <form action="{{ route('cart.add', [$product->id]) }}">
                    <img src="https://static.vecteezy.com/system/resources/previews/009/384/620/original/fresh-pizza-and-pizza-box-clipart-design-illustration-free-png.png"
                        alt="">
                    <p class="font-bold">{{ $product->name }}</p>
                    <p>€ {{ number_format($product->price, 2) }}</p>
                    <select class="appearance-none w-full rounded bg-gray-100 my-1" name="size" id="size">
                        <option value="25">(25 cm) Small -€ 1,50</option>
                        <option value="29" selected>(29 cm) Medium</option>
                        <option value="35">(35 cm) Large +€ 1,50</option>
                        <option value="40">(40 cm) XXL +€ 3,00</option>
                    </select>
                    <div class="flex">
                        <select name="quantity" id="quantity" class="w-[40%] text-sm">
                            @for ($i = 1; $i < 11; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <input class="btn w-[60%] ml-1" type="submit" value="Add to cart">
                    </div>
                    @foreach ($ingredients as $ingredient)
                        @if ($product->ingredients->contains($ingredient))
                            <input name="ingredients[]" type="hidden" value="{{ $ingredient->id }}">
                        @endif
                    @endforeach
                </form>
            </div>
        @endforeach
    </div>
</div>
