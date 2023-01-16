@extends('layouts.dashboard')

@section('title')
    Products
@endsection

@section('content')
    @foreach ($products as $product)
        <div><a href="{{ route('products.edit', ['product' => $product->id]) }}">{{ $product->name }}</a></div>
    @endforeach
@endsection
