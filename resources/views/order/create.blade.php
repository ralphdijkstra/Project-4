@extends('layouts.order')

@section('title')
    Order
@endsection

@section('product-list')
    <x-product-list />
@endsection
@section('shopping-cart')
    <p class="text-xl font-bold dark:text-white">Details Order</p>
    <hr>
    <x-shopping-cart />
@endsection
