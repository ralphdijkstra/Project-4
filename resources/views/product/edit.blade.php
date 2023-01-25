@extends('layouts.dashboard')

@section('title')
    {{ $product->name }}
@endsection

@section('content')
<form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST">
    @csrf @method('PATCH')
    <div>Name: <input type="text" name="name" id="name" value="{{ $product->name }}"></div>
    @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
    <div>Description: <input type="text" name="description" id="description" value="{{ $product->description }}"></div>
    @error('description')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
    <div>Image: <input type="text" name="image" id="image" value="{{ $product->image }}"></div>
    @error('image')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
    <div>Price: <input type="number" name="price" id="price" step="any" value="{{ $product->price }}"></div>
    @error('price')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
    <div><input type="submit" class="btn" value="Edit"></div>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
    {{-- CATEGORY --}}
</form>
@endsection
