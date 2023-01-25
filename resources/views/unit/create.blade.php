@extends('layouts.dashboard')

@section('title')
    Create Unit
@endsection

@section('content')
<form action="{{ route('units.store') }}" method="POST">
    @csrf 
    <div>Name: <input type="text" name="name" id="name" value=""></div>
    @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
    <div><input type="submit" class="btn" value="Create"></div>
    <a href="{{ route('units.index') }}" class="btn btn-secondary">Cancel</a>
    {{-- CATEGORY --}}
</form>
@endsection
