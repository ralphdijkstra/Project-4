@extends('layouts.dashboard')

@section('title')
    Order
@endsection

@section('content')
    @if (session()->has('success'))
        <div class="m-1 p-3 text-green-500 bg-green-200 rounded-md">
            {{ Session::get('success') }}
        </div>
    @endif

    <x-product-list />

    <div class="p-6">
        <div class="text-xl font-bold">Details Order</div>
        <form action="">
            Address:

            @if (session('addresses') !== null)
                @foreach (session('addresses') as $address => $details)
                    <div class="flex items-center btn p-3 m-1">
                        <input class="mr-5 cursor-pointer" type="checkbox" name="address" id="address">
                        <label class="cursor-pointer w-full h-full" for="address">{{ $details['address'] }}, {{ $details['postal_code'] }} {{ $details['city'] }}</label>
                    </div>
                @endforeach
            @endif
        </form>
        <button class="btn btn-success p-3 m-1 flex items-center w-full" onclick="openModal('modal')"><i
                class="fa fa-plus mr-5" aria-hidden="true"></i> Add address</button>

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

        @auth
            Bezorgen naar:
            {{ Auth::user()->person->address }}
            {{ Auth::user()->person->postal_code }}
            {{ Auth::user()->person->city }}
        @endauth
        <div class="text-xl font-bold mt-6">Shopping Cart</div>
        <x-shopping-cart />
    </div>
@endsection
