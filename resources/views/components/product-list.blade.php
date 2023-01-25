<div class="p-3">
    <div class="grid 2xl:grid-cols-4 xl:grid-cols-3 grid-cols-2">
        @foreach ($products as $product)
            <div class="bg-white m-2 rounded-lg px-1 py-2">
                <form action="{{ route('cart.add', [$product->id]) }}">
                    @csrf
                    <img src="https://static.vecteezy.com/system/resources/previews/009/384/620/original/fresh-pizza-and-pizza-box-clipart-design-illustration-free-png.png"
                        alt="" onclick="openModal('modal{{ $product->id }}')">
                    <p class="font-bold">{{ $product->name }}</p>
                    <p>€ {{ number_format($product->price, 2) }}</p>
                    <p class="line-clamp-2 text-sm">{{ $product->description }}</p>
                    <select class="appearance-none w-full rounded bg-gray-100 my-1 cursor-pointer" name="size"
                        id="size">
                        <option value="25">(25 cm) Small -€ 1,50</option>
                        <option value="29" selected>(29 cm) Medium</option>
                        <option value="35">(35 cm) Large +€ 1,50</option>
                        <option value="40">(40 cm) XXL +€ 3,00</option>
                    </select>
                    <div class="flex">
                        <select name="quantity" id="quantity"
                            class="w-[40%] text-md rounded bg-gray-100 cursor-pointer">
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
                <div id="modal{{ $product->id }}"
                    class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto px-4 modal">
                    <div class="relative top-28 mx-auto shadow-xl rounded-md bg-gray-200 max-w-lg">

                        <!-- Modal header -->
                        <div
                            class="flex justify-between items-center bg-blue-500 text-white text-xl rounded-t-md px-4 py-2">
                            <h3>{{ $product->name }}</h3>
                            <button onclick="closeModal('modal{{ $product->id }}')">x</button>
                        </div>

                        <!-- Modal body -->
                        <div class="overflow-y-scroll max-h-96 p-1">
                            <form action="{{ route('cart.add', [$product->id]) }}">
                                @csrf
                                <img class="w-[70%] mx-auto"
                                    src="https://static.vecteezy.com/system/resources/previews/009/384/620/original/fresh-pizza-and-pizza-box-clipart-design-illustration-free-png.png"
                                    alt="">
                                <div class="rounded-lg bg-white m-3 p-3">
                                    <p class="text-xl font-bold">{{ $product->name }}</p>
                                    <p>{{ $product->description }}</p>
                                </div>
                                <div class="rounded-lg bg-white m-3 p-3 flex items-center">
                                    <p class="text-xl font-bold mr-5">Size</p>
                                    <select class="appearance-none w-full rounded bg-gray-100 my-1 cursor-pointer"
                                        name="size" id="size">
                                        <option value="25">(25 cm) Small -€ 1,50</option>
                                        <option value="29" selected>(29 cm) Medium</option>
                                        <option value="35">(35 cm) Large +€ 1,50</option>
                                        <option value="40">(40 cm) XXL +€ 3,00</option>
                                    </select>
                                </div>
                                <div class="rounded-lg bg-white m-3 p-3">
                                    <p class="text-xl font-bold mr-5">Ingredients</p>
                                    <select class="w-full" name="ingredients[]" id="ingredients" multiple>
                                        @foreach ($ingredients as $ingredient)
                                            <option value="{{ $ingredient->id }}"
                                                @if ($product->ingredients->contains($ingredient)) selected @endif>
                                                {{ $ingredient->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="px-4 py-2 border-t border-t-gray-500 flex items-center justify-between space-x-4">
                            <div class="flex">
                                <button class="bg-white w-10 h-10 flex rounded-full" data-action="decrement"
                                    type="button"><i class="fa fa-minus text-blue-500 m-auto"></i></button>
                                <input
                                    class="bg-transparent border-none cursor-default text-center focus:ring-0 w-12 font-bold"
                                    type="text" name="quantity" id="quantity" value="1" readonly>
                                <button class="bg-blue-500 w-10 h-10 flex rounded-full" data-action="increment"
                                    type="button"><i class="fa fa-plus text-white m-auto"></i></button>
                            </div>
                            <div>
                                <button class="btn btn-warning" type="button"
                                    onclick="closeModal('modal{{ $product->id }}')">Cancel</button>
                                <input class="btn" type="submit" value="Confirm">
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
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
        const btn = e.target.parentNode.parentElement.querySelector(
            'button[data-action="decrement"]'
        );
        const target = btn.nextElementSibling;
        let value = Number(target.value);
        if (value != 1) {
            value--;
        }
        target.value = value;
    }

    function increment(e) {
        const btn = e.target.parentNode.parentElement.querySelector(
            'button[data-action="decrement"]'
        );
        const target = btn.nextElementSibling;
        let value = Number(target.value);
        if (value != 10) {
            value++;
        }
        target.value = value;
    }

    const decrementButtons = document.querySelectorAll(
        `button[data-action="decrement"]`
    );

    const incrementButtons = document.querySelectorAll(
        `button[data-action="increment"]`
    );

    decrementButtons.forEach(btn => {
        btn.addEventListener("click", decrement);
    });

    incrementButtons.forEach(btn => {
        btn.addEventListener("click", increment);
    });
</script>
