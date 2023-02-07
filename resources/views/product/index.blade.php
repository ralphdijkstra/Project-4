@extends('layouts.dashboard')

@section('title')
    Products
@endsection

@section('content')
    @foreach ($products as $product)
  

    <div class="grid grid-cols-4 mb-1">  
        {{ $product->name }}
        <div>
        <a href="{{ route('products.edit', ['product' => $product->id]) }}">
           <input type="submit" class="btn" value="Edit"></a>
        <a href="{{ route('products.delete', ['id' => $product->id]) }}">
           <input type="submit" class="btn btn-warning" value="Delete"></a>
</div>
    </div>
   
    @endforeach
    <div> 
    <a href="{{ route('products.create') }}">
    <input type="submit" class="btn" value="Create"></a>
    </div>
@endsection


