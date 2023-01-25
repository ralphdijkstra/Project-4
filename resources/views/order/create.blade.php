@extends('layouts.order')

@section('title')
    Order
@endsection

@section('product-list')    
    <x-product-list />
@endsection
@section('shopping-cart')
    <p class="text-xl font-bold">Details Order</p>
    <hr class="h-px my-1 bg-gray-200 border-0">
    <x-shopping-cart />
@endsection
