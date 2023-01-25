<div class="p-3">
    <div class="grid 2xl:grid-cols-4 xl:grid-cols-3 grid-cols-2">
        @foreach ($products as $product)
            <div class="bg-white m-2 rounded-lg px-1 py-2">
                <form action="{{ route('cart.add', [$product->id]) }}">
                    <img src="https://static.vecteezy.com/system/resources/previews/009/384/620/original/fresh-pizza-and-pizza-box-clipart-design-illustration-free-png.png"
                        alt="">
                    <p class="font-bold">{{ $product->name }}</p>
                    <p>€ {{ number_format($product->price, 2) }}</p>
                    <select class="appearance-none w-full rounded bg-gray-100 my-1 cursor-pointer" name="size" id="size">
                        <option value="25">(25 cm) Small -€ 1,50</option>
                        <option value="29" selected>(29 cm) Medium</option>
                        <option value="35">(35 cm) Large +€ 1,50</option>
                        <option value="40">(40 cm) XXL +€ 3,00</option>
                    </select>
                    <div class="flex">
                        <select name="quantity" id="quantity" class="w-[40%] text-md rounded bg-gray-100 cursor-pointer">
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
                    {{-- <select class="w-full" name="ingredients[]" id="ingredients" multiple>
                        @foreach ($ingredients as $ingredient)
                            <option value="{{ $ingredient->id }}" @if ($product->ingredients->contains($ingredient)) selected @endif >{{ $ingredient->name }}</option>
                        @endforeach
                    </select> --}}
                </form>
            </div>
        @endforeach
    </div>
</div>
