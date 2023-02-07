@extends('layouts.dashboard')

@section('title')
    Create product
@endsection

@section('content')
<form action="{{ route('products.store') }}" method="POST">
    @csrf
    <div>Name: <input type="text" name="name" id="name" value=""></div>
    @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
    <div>Description: <input type="text" name="description" id="description" value=""></div>
    @error('description')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
    <div>Image: <input type="text" name="image" id="image" value=""></div>
    @error('image')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
    <div>Price: <input type="number" name="price" id="price" step="any" value=""></div>
    @error('price')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
    <div><input type="submit" class="btn" value="Create"></div>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
    {{-- CATEGORY --}}
</form>
@endsection
