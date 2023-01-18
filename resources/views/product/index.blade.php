@extends('layouts.dashboard')

@section('title')
    Products
@endsection

@section('content')
    @foreach ($products as $product)
    {{--<div>  {{ $product->name }}<a href="{{ route('products.edit', ['product' => $product->id]) }}">
           <input type="submit" class="btn" value="Edit"></a>
    </div>--}}

    <div>  {{ $product->name }}
        <a href="{{ route('products.edit', ['product' => $product->id]) }}">
           <input type="submit" class="btn" value="Edit"></a>
        <a href="{{ route('products.delete', ['id' => $product->id]) }}">
           <input type="submit" class="btn btn-warning" value="Delete"></a>
    </div>
    @endforeach
@endsection


