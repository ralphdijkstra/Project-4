<div>
    @if (session('cart'))
        <?php $total = 0;
        $x = 0; ?>
        <div class="py-3">
            <div class="grid grid-cols-7">
                <div class="font-bold">Product</div>
                <div class="font-bold">Price</div>
                <div class="font-bold">Quantity</div>
                <div class="font-bold">Size</div>
                <div class="font-bold">Changes</div>
                <div class="font-bold">Subtotal</div>
                <div></div>
            </div>
            @foreach (session('cart') as $id => $details)
                <?php $total += $details['price'] * $details['quantity'];
                $x++; $key = $details['id'] - 1; ?>
                <div class="grid grid-cols-7 py-3">
                    <div>{{ $details['name'] }}</div>
                    <div>
                        @switch($details['size'])
                            @case(25)
                                <?php $price = $details['price'] - 1.5; ?>
                                € {{ number_format($price, 2) }}
                            @break

                            @case(29)
                                <?php $price = $details['price']; ?>
                                € {{ number_format($price, 2) }}
                            @break

                            @case(35)
                                <?php $price = $details['price'] + 1.5; ?>
                                € {{ number_format($price, 2) }}
                            @break

                            @case(40)
                                <?php $price = $details['price'] + 3; ?>
                                € {{ number_format($price, 2) }}
                            @break

                            @default
                        @endswitch
                    </div>
                    <div>{{ $details['quantity'] }}</div>
                    <div>{{ $details['size'] }} cm</div>
                    <div>
                        @foreach ($ingredients as $ingredient)
                            @if ($products[$key]->ingredients->contains($ingredient))
                                @if (!in_array($ingredient->id, $details['ingredients']))
                                <i class="fa fa-minus"></i> {{ $ingredient->name }} <br>
                                @endif
                            @else
                                @if (in_array($ingredient->id, $details['ingredients']))
                                    <i class="fa fa-plus"></i> {{ $ingredient->name }} <br>
                                @endif
                            @endif
                        @endforeach
                    </div>
                    <div>€ {{ number_format($price * $details['quantity'], 2) }}</div>
                    <div class="flex">
                        <form action="{{ route('cart.remove', ['id' => $id]) }}" method="POST">
                            @csrf @method('delete')
                            <input class="font-bold text-red-500" type="submit" value="Verwijder" />
                        </form>
                        <button class="font-bold text-blue-500 px-3"
                            onclick="openModal('modal{{ $id }}')">Edit</button>

                        <div id="modal{{ $id }}"
                            class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto px-4 modal">
                            <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white max-w-sm">

                                <!-- Modal header -->
                                <div
                                    class="flex justify-between items-center bg-blue-500 text-white text-xl rounded-t-md px-4 py-2">
                                    <h3>{{ $details['name'] }}</h3>
                                    <button onclick="closeModal('modal{{ $id }}')">x</button>
                                </div>

                                <!-- Modal body -->
                                <div class="max-h-48 overflow-y-scroll p-4">
                                    <form method="POST" action="{{ route('cart.refresh') }}">
                                        @csrf
                                        @method('patch')
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <input type="hidden" name="name" value="{{ $details['name'] }}">
                                        <div>
                                            <label class="block" for="quantity">Quantity:</label>
                                            <input class="mb-5" type="number" min="1" name="quantity"
                                                id="quantity" value="{{ $details['quantity'] }}">
                                        </div>
                                        <div>
                                            <label class="block" for="size">Size:</label>
                                            <select class="mb-5" name="size" id="size">
                                                <option value="25"
                                                    @if ($details['size'] == 25) selected @endif>
                                                    (25 cm)
                                                    Small -€ 1,50
                                                </option>
                                                <option value="29"
                                                    @if ($details['size'] == 29) selected @endif>
                                                    (29 cm) Medium
                                                </option>
                                                <option value="35"
                                                    @if ($details['size'] == 35) selected @endif>
                                                    (35 cm) Large +€ 1,50
                                                </option>
                                                <option value="40"
                                                    @if ($details['size'] == 40) selected @endif>
                                                    (40 cm) XXL +€ 3,00
                                                </option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block" for="ingredients">Ingredients:</label>
                                            <select class="mb-5" name="ingredients[]" id="ingredients" multiple>
                                                @foreach ($ingredients as $ingredient)
                                                    <option value="{{ $ingredient->id }}"
                                                        @if (in_array($ingredient->id, $details['ingredients'])) selected @endif>
                                                        {{ $ingredient->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                </div>

                                <!-- Modal footer -->
                                <div
                                    class="px-4 py-2 border-t border-t-gray-500 flex justify-end items-center space-x-4">
                                    <button class="btn btn-warning" type="button"
                                        onclick="closeModal('modal{{ $id }}')">Cancel</button>
                                    <input class="btn" type="submit" value="Confirm">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <form action="{{ route('orders.store') }}" method="POST">
                <div class="text-xl font-bold py-3">Bezorgen naar:</div>
                @auth
                    <div class="py-3">
                        <div>
                            Address: <input type="text" name="address" id="address"
                                value="{{ Auth::user()->person->address }}" readonly>
                        </div>
                        <div>
                            Postal code: <input type="text" name="postal_code" id="postal_code"
                                value="{{ Auth::user()->person->postal_code }}" readonly>
                        </div>
                        <div>
                            City: <input type="text" name="city" id="city"
                                value="{{ Auth::user()->person->city }}" readonly>
                        </div>
                    </div>
                @else
                    <div class="py-3">
                        <div>
                            Name: <input type="text" name="guest_name" id="guest_name">
                        </div>
                        <div>
                            Address: <input type="text" name="address" id="address">
                        </div>
                        <div>
                            Postal code: <input type="text" name="postal_code" id="postal_code">
                        </div>
                        <div>
                            City: <input type="text" name="city" id="city">
                        </div>
                    </div>
                @endauth
                <div class="font-bold btn w-60 my-3">
                    @csrf
                    <input type="submit"
                        @if ($x > 1) value="{{ $x }} Items | € {{ $total }} Afrekenen"
                        @else value="{{ $x }} Item | € {{ $total }} Afrekenen" @endif>
                </div>
            </form>
    @endif
</div>
</div>

<script type="text/javascript">
    window.openModal = function(modalId) {
        document.getElementById(modalId).style.display = 'block'
        document.getElementsByTagName('body')[0].classList.add('overflow-y-hidden')
    }

    window.closeModal = function(modalId) {
        document.getElementById(modalId).style.display = 'none'
        document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
    }

    // Close all modals when press ESC
    document.onkeydown = function(event) {
        event = event || window.event;
        if (event.keyCode === 27) {
            document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
            let modals = document.getElementsByClassName('modal');
            Array.prototype.slice.call(modals).forEach(i => {
                i.style.display = 'none'
            })
        }
    };
</script>
