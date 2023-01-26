<div>
    @if (session('cart'))
        <?php $total = 0;
        $x = 0; ?>
        @foreach (session('cart') as $id => $details)
            <?php $total += $details['price'] * $details['quantity'];
            $x++;
            $key = $details['id'] - 1; ?>
            <div class="my-3">
                <div class="flex px-1 dark:text-white">
                    <div class="w-[10%] font-bold">{{ $details['quantity'] }} x</div>
                    <div class="w-[70%] flex flex-col">
                        <div class="font-bold">{{ $details['name'] }}</div>
                        <div><span class="font-bold">Size:</span> {{ $details['size'] }} cm</div>
                        <div>
                            <span class="font-bold">Changes:</span><br>
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
                    </div>
                    <div class="w-[20%] font-bold text-right">
                        @switch($details['size'])
                            @case(25)
                                <?php $price = $details['price'] - 1.5; ?>
                            @break

                            @case(29)
                                <?php $price = $details['price']; ?>
                            @break

                            @case(35)
                                <?php $price = $details['price'] + 1.5; ?>
                            @break

                            @case(40)
                                <?php $price = $details['price'] + 3; ?>
                            @break

                            @default
                        @endswitch
                        € {{ number_format($price * $details['quantity'], 2) }}
                    </div>
                </div>
                <div class="flex mt-3">
                    <form action="{{ route('cart.remove', ['id' => $id]) }}" method="POST">
                        @csrf @method('delete')
                        <input class="font-bold text-red-500" type="submit" value="Delete" />
                    </form>
                    <button class="font-bold text-blue-500 px-3"
                        onclick="openModal('modal{{ $id }}')">Edit</button>

                    <div id="modal{{ $id }}"
                        class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto px-4 modal">
                        <div
                            class="relative top-28 mx-auto shadow-xl rounded-md bg-gray-200 dark:bg-slate-700 max-w-lg">

                            <!-- Modal header -->
                            <div
                                class="flex justify-between items-center bg-blue-500 dark:bg-slate-800 text-white text-xl rounded-t-md px-4 py-2">
                                <h3>{{ $details['name'] }}</h3>
                                <button onclick="closeModal('modal{{ $id }}')">x</button>
                            </div>

                            <!-- Modal body -->
                            <div class="overflow-y-scroll max-h-96 p-1">
                                <form method="POST" action="{{ route('cart.refresh') }}">
                                    @csrf
                                    @method('patch')
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <input type="hidden" name="name" value="{{ $details['name'] }}">
                                    <img class="w-[70%] mx-auto"
                                        src="https://static.vecteezy.com/system/resources/previews/009/384/620/original/fresh-pizza-and-pizza-box-clipart-design-illustration-free-png.png"
                                        alt="">
                                    <div class="rounded-lg bg-white dark:bg-slate-800 m-3 p-3">
                                        <p class="text-xl font-bold">{{ $details['name'] }}</p>
                                        <p>{{ $details['description'] }}</p>
                                    </div>
                                    <div class="rounded-lg bg-white dark:bg-slate-800 m-3 p-3 flex items-center">
                                        <p class="text-xl font-bold mr-5">Size</p>
                                        <select
                                            class="appearance-none w-full rounded bg-transparent my-1 cursor-pointer"
                                            name="size" id="size">
                                            <option class="dark:text-black" value="25"
                                                @if ($details['size'] == 25) selected @endif>(25 cm) Small -€ 1,50
                                            </option>
                                            <option class="dark:text-black" value="29"
                                                @if ($details['size'] == 29) selected @endif>(29 cm) Medium
                                            </option>
                                            <option class="dark:text-black" value="35"
                                                @if ($details['size'] == 35) selected @endif>(35 cm) Large +€ 1,50
                                            </option>
                                            <option class="dark:text-black" value="40"
                                                @if ($details['size'] == 40) selected @endif>(40 cm) XXL +€ 3,00
                                            </option>
                                        </select>
                                    </div>
                                    <div class="rounded-lg bg-white dark:bg-slate-800 m-3 p-3">
                                        <p class="text-xl font-bold mr-5">Ingredients</p>
                                        <select class="w-full bg-transparent" name="ingredients[]" id="ingredients"
                                            multiple>
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
                                class="px-4 py-2 border-t border-t-gray-500 flex items-center justify-between space-x-4">
                                <div class="flex">
                                    <button class="bg-white w-10 h-10 flex rounded-full" data-action="decrement2"
                                        type="button"><i class="fa fa-minus text-blue-500 m-auto"></i></button>
                                    <input
                                        class="bg-transparent border-none cursor-default text-center focus:ring-0 w-12 font-bold"
                                        type="text" name="quantity" id="quantity"
                                        value="{{ $details['quantity'] }}" readonly>
                                    <button class="bg-blue-500 w-10 h-10 flex rounded-full" data-action="increment2"
                                        type="button"><i class="fa fa-plus text-white m-auto"></i></button>
                                </div>
                                <div>
                                    <button class="btn btn-warning" type="button"
                                        onclick="closeModal('modal{{ $id }}')">Cancel</button>
                                    <input class="btn" type="submit" value="Confirm">
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        @endforeach
        <form action="{{ route('orders.store') }}" method="POST">
            <div class="py-3 dark:text-white">
                <p class="text-xl font-bold">Pizza Points:</p>
                @auth
                    <p>With this order you collect {{ round($total * 10, 0) }} Pizza Points!</p>
                    <input type="hidden" name="pizzapoints" value="{{ round($total * 10, 0) }}">
                @else
                    <p>Log in to collect {{ round($total * 10, 0) }} Pizza Points!</p>
                @endauth
            </div>
            <hr>
            <div class="text-xl font-bold pt-3 dark:text-white">Deliver To:</div>
            @auth
                <div class="py-3">
                    <div class="flex justify-between items-center dark:text-white pb-1">
                        <p>Name:</p>
                        <input class="bg-transparent" type="text" name="guest_name" id="guest_name"
                            value="{{ Auth::user()->name }}">
                    </div>
                    <div class="flex justify-between items-center dark:text-white pb-1">
                        <p>Adress:</p>
                        <input class="bg-transparent" type="text" name="address" id="address"
                            value="{{ Auth::user()->person->address }}">
                    </div>
                    <div class="flex justify-between items-center dark:text-white pb-1">
                        <p>Postal Code:</p>
                        <input class="bg-transparent" type="text" name="postal_code" id="postal_code"
                            value="{{ Auth::user()->person->postal_code }}">
                    </div>
                    <div class="flex justify-between items-center dark:text-white pb-1">
                        <p>City:</p>
                        <input class="bg-transparent" type="text" name="city" id="city"
                            value="{{ Auth::user()->person->city }}">
                    </div>
                </div>
            @else
                <div class="py-3">
                    <div class="flex justify-between items-center dark:text-white pb-1">
                        <p>Name:</p>
                        <input class="bg-transparent" type="text" name="guest_name" id="guest_name">
                    </div>
                    <div class="flex justify-between items-center dark:text-white pb-1">
                        <p>Adress:</p>
                        <input class="bg-transparent" type="text" name="address" id="address">
                    </div>
                    <div class="flex justify-between items-center dark:text-white pb-1">
                        <p>Postal Code:</p>
                        <input class="bg-transparent" type="text" name="postal_code" id="postal_code">
                    </div>
                    <div class="flex justify-between items-center dark:text-white pb-1">
                        <p>City:</p>
                        <input class="bg-transparent" type="text" name="city" id="city">
                    </div>
                </div>
            @endauth
            @csrf
            <input type="submit" class="btn w-full py-3 rounded-2xl"
                @if ($x > 1) value="{{ $x }} Items | € {{ number_format($total, 2) }} Afrekenen"
                        @else value="{{ $x }} Item | € {{ number_format($total, 2) }} Afrekenen" @endif>
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

<script>
    function decrement(e) {
        const btn = e.target.parentNode.parentElement.querySelector([
            'button[data-action="decrement"]',
            'button[data-action="decrement2"]'
        ]);
        const target = btn.nextElementSibling;
        let value = Number(target.value);
        if (value != 1) {
            value--;
        }
        target.value = value;
    }

    function increment(e) {
        const btn = e.target.parentNode.parentElement.querySelector([
            'button[data-action="decrement"]',
            'button[data-action="decrement2"]'
        ]);
        const target = btn.nextElementSibling;
        let value = Number(target.value);
        if (value != 10) {
            value++;
        }
        target.value = value;
    }

    const decrementButtons = document.querySelectorAll([
        `button[data-action="decrement"]`,
        `button[data-action="decrement2"]`
    ]);

    const incrementButtons = document.querySelectorAll([
        `button[data-action="increment"]`,
        `button[data-action="increment2"]`
    ]);

    decrementButtons.forEach(btn => {
        btn.addEventListener("click", decrement);
    });

    incrementButtons.forEach(btn => {
        btn.addEventListener("click", increment);
    });
</script>
