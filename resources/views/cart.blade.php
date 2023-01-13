@extends('layouts.dashboard')

@section('content')
    <?php $total = 0; ?>
    @if (session()->has('success'))
        <div class="m-1 p-3 text-green-500 bg-green-200 rounded-md">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="p-5 grid grid-cols-5">
        {{-- Headers --}}
        <div class="font-bold h-12">Product</div>
        <div class="font-bold">Price</div>
        <div class="font-bold">Quantity</div>
        <div class="font-bold">Subtotal</div>
        <div></div>
        {{-- End of Headers --}}

        @if (session('cart'))
            @foreach (session('cart') as $id => $details)
                <?php $total += $details['price'] * $details['quantity']; ?>
                <div class="h-12">{{ $details['name'] }}</div>
                <div>€ {{ $details['price'] }}</div>
                <div>
                    <form method="POST" action="{{ route('product.refresh') }}">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="id" value="{{ $id }}">
                        <input class="w-24" type="number" name="quantity" value="{{ $details['quantity'] }}" />
                        <input type="submit" class="btn" value="Refresh" />
                    </form>
                </div>
                <div>€ {{ $details['price'] * $details['quantity'] }}</div>
                <div>
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
@endsection
