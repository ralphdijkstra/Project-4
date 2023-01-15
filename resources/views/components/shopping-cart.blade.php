<div>
    <?php $total = 0; ?>
    <div class="p-5 grid grid-cols-6">
        {{-- Headers --}}
        <div class="font-bold h-12">Product</div>
        <div class="font-bold">Price</div>
        <div class="font-bold">Quantity</div>
        <div class="font-bold">Size</div>
        <div class="font-bold">Subtotal</div>
        <div></div>
        {{-- End of Headers --}}

        @if (session('cart'))
            @foreach (session('cart') as $id => $details)
                <?php $total += $details['price'] * $details['quantity']; ?>
                <div class="h-12">{{ $details['name'] }}</div>
                <div>
                    @switch($details['size'])
                        @case(25)
                            € {{ number_format(($details['price'] - 1.5), 2)}}
                        @break
                        @case(29)
                            € {{ number_format($details['price'], 2) }}
                        @break
                        @case(35)
                            € {{ number_format(($details['price'] + 1.5), 2) }}
                        @break
                        @case(40)
                            € {{ number_format(($details['price'] + 3), 2) }}
                        @break

                        @default
                    @endswitch
                </div>
                <div>
                    <form method="POST" action="{{ route('product.refresh') }}">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="id" value="{{ $id }}">
                        <input class="w-24" type="number" name="quantity" min="1"
                            value="{{ $details['quantity'] }}" />
                </div>
                <div>
                    <select name="size" id="size">
                        <option value="25" @if ($details['size'] == 25) selected @endif>25 cm Small
                        </option>
                        <option value="29" @if ($details['size'] == 29) selected @endif>29 cm Medium
                        </option>
                        <option value="35" @if ($details['size'] == 35) selected @endif>35 cm Large
                        </option>
                        <option value="40" @if ($details['size'] == 40) selected @endif>40 cm XXL</option>
                    </select>
                </div>
                <div>€ {{ $details['price'] * $details['quantity'] }}</div>
                <div>
                    <input type="submit" class="btn" value="Update" />
                    </form>
                    <form method="POST" action="{{ route('product.remove') }}">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="id" value="{{ $id }}">
                        <input type="hidden" name="quantity" value="{{ $details['quantity'] }} ">
                        <input type="submit" class="btn btn-warning" value="Delete" />
                    </form>
                </div>
            @endforeach
            <div class="col-span-3"></div>
            <div class="font-bold">
                Total € {{ $total }}
            </div>
            <div>
                <a class="btn btn-warning">Delete All</a>
            </div>
        @endif
    </div>
</div>
