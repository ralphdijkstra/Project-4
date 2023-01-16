@extends('layouts.dashboard')

@section('title')
    {{ $product->name }}
@endsection

@section('content')
<form action="" method="">
    <div>Name: <input type="text" name="name" id="name" value="{{ $product->name }}"></div>
    <div>Description: <input type="text" name="name" id="name" value="{{ $product->description }}"></div>
    <div>Image: <input type="text" name="name" id="name" value="{{ $product->image }}"></div>
    <div>Price: <input type="number" name="name" id="name" value="{{ $product->price }}"></div>
    <div><input type="submit" class="btn" value="Edit"></div>
    {{-- CATEGORY --}}
</form>
@endsection
