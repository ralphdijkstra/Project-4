@extends('layouts.order')

@section('title')
    Order
@endsection

@section('product-list')
    <x-product-list />
@endsection
@section('shopping-cart')
    @if (session()->has('success'))
        <div class="m-1 p-3 text-green-500 bg-green-200 rounded-md">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="p-6">
        <div class="text-xl font-bold">Details Order</div>
    </div>
    <x-shopping-cart />
@endsection
