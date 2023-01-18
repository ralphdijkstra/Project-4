<div>
    <?php
    // $selected_address = [
    //     'address' => "Waterfront 451",
    //     'postal_code' => "5658 SM",
    //     'city' => "Eindhoven",
    // ];
    ?>  
    @dump($selected_address)
    <div class="text-xl font-bold">Details Order</div>
    <form action="{{ route('address.set') }}" method="POST">
        @csrf
        Address:

        @if (session('addresses') !== null)
            <?php $x = 0; ?>
            @foreach (session('addresses') as $address => $details)
                <div class="flex items-center btn p-3 m-1 w-full">
                    <input class="mr-5 cursor-pointer" type="radio"
                        @empty($selected_address) 
                            checked 
                            <?php
                            $selected_address = [
                                'address' => $details['address'],
                                'postal_code' => $details['postal_code'],
                                'city' => $details['city'],
                            ];
                            ?>  
                            @else
                            @if($selected_address == session('addresses')[$address]) 
                            checked
                            @endif
                        @endempty
                        name="address" id="{{ $address }}" value="{{ $address }}">
                    <label class="cursor-pointer w-full h-full" for="address">{{ $details['address'] }},
                        {{ $details['postal_code'] }} {{ $details['city'] }}</label>
                    @auth
                        @if (Auth::user()->person->address != $details['address'])
                            <a href="{{ route('address.delete', ['id' => $address]) }}" class="fa fa-trash"
                                aria-hidden="true"></a>
                        @endif
                    @else
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    @endauth
                </div>
                <?php $x++; ?>
            @endforeach
            @dump($selected_address)
        @endif
        <button type="button" class="btn btn-success p-3 m-1 flex items-center w-full" onclick="openModal('modal')"><i
                class="fa fa-plus ml-0.5 mr-5" aria-hidden="true"></i> Add address</button>
        <input type="submit" value="set">
    </form>

    <div id="modal" class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto px-4 modal">
        <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white max-w-sm">

            <!-- Modal header -->
            <div class="flex justify-between items-center bg-green-500 text-white text-xl rounded-t-md px-4 py-2">
                <h3>Add address</h3>
                <button onclick="closeModal('modal')">x</button>
            </div>

            <!-- Modal body -->
            <div class="max-h-48 p-4">
                <form action="{{ route('orders.create') }}" method="POST">
                    @csrf
                    <div>
                        <label for="address">Address:</label>
                        <input type="text" name="address" id="address">
                    </div>
                    <div>
                        <label for="postal_code">Postal code:</label>
                        <input type="text" name="postal_code" id="postal_code">
                    </div>
                    <div>
                        <label for="city">City:</label>
                        <input type="text" name="city" id="city">
                    </div>
            </div>

            <!-- Modal footer -->
            <div class="px-4 py-2 border-t border-t-gray-500 flex justify-end items-center space-x-4">
                <button type="button" class="btn btn-warning" onclick="closeModal('modal')">Cancel</button>
                <input class="btn btn-success" type="submit" value="Confirm"></form>
            </div>
        </div>
    </div>
    <div class="text-xl font-bold mt-6">Shopping Cart</div>
    <?php $total = 0;
    $x = 0; ?>
    <div class="p-5">
        <div class="grid grid-cols-6">
            <div class="font-bold">Product</div>
            <div class="font-bold">Price</div>
            <div class="font-bold">Quantity</div>
            <div class="font-bold">Size</div>
            <div class="font-bold">Subtotal</div>
            <div></div>
        </div>

        @if (session('cart'))
            @foreach (session('cart') as $id => $details)
                <?php $total += $details['price'] * $details['quantity'];
                $x++; ?>
                <div class="grid grid-cols-6 py-3">
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
                    <div>€ {{ number_format($price * $details['quantity'], 2) }}</div>
                    <div class="flex">
                        <form action="{{ route('product.remove', ['id' => $id]) }}" method="POST">
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
                                    <form method="POST" action="{{ route('product.refresh') }}">
                                        @csrf
                                        @method('patch')
                                        {{-- Hidden Inputs --}}
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <input type="hidden" name="name" value="{{ $details['name'] }}">
                                        <div>
                                            <label class="block" for="quantity">Quantity:</label>
                                            <input class="mb-5" type="number" min="1" name="quantity"
                                                id="quantity" value="{{ $details['quantity'] }}">
                                        </div>
                                        <label class="block" for="size">Size:</label>
                                        <select class="mb-5" name="size" id="size">
                                            <option value="25" @if ($details['size'] == 25) selected @endif>
                                                (25 cm)
                                                Small -€ 1,50
                                            </option>
                                            <option value="29" @if ($details['size'] == 29) selected @endif>
                                                (29 cm) Medium
                                            </option>
                                            <option value="35" @if ($details['size'] == 35) selected @endif>
                                                (35 cm) Large +€ 1,50
                                            </option>
                                            <option value="40" @if ($details['size'] == 40) selected @endif>
                                                (40 cm) XXL +€ 3,00
                                            </option>
                                        </select>

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
            <div class="font-bold btn w-60">
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <input type="text" name="address" value="{{ $selected_address['address'] }}">
                    <input type="text" name="postal_code" value="{{ $selected_address['postal_code'] }}">
                    <input type="text" name="city" value="{{ $selected_address['city'] }}">
                    <input type="submit"
                        @if ($x > 1) value="{{ $x }} Items | € {{ $total }} Afrekenen"
                        @else value="{{ $x }} Item | € {{ $total }} Afrekenen" @endif>
                </form>
            </div>
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
