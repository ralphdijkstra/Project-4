@extends('layouts.dashboard')

@section('title')
    {{ $ingredient->name }}
@endsection

@section('content')
<form action="{{ route('ingredients.update', ['ingredient' => $ingredient->id]) }}" method="POST">
    @csrf @method('PATCH')
    <div>Name: <input type="text" name="name" id="name" value="{{ $ingredient->name }}"></div>
    @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
    <div>Price: <input type="text" name="price" id="price" step="any" value="{{ $ingredient->price }}"></div>
    @error('price')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
    <div>Image: <input type="text" name="image" id="image" value="{{ $ingredient->image }}"></div>
    @error('image')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
<div><input type="submit" class="btn" value="Edit"></div>
    <a href="{{ route('ingredients.index') }}" class="btn btn-secondary">Cancel</a>
    {{-- CATEGORY --}}
</form>
@endsection
