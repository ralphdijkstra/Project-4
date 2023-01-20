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
        <div class="text-xl font-bold mt-6">Shopping Cart</div>
        <x-shopping-cart />
    </div>
@endsection
