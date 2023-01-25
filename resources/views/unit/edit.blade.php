@extends('layouts.dashboard')

@section('title')
    {{ $unit->name }}
@endsection

@section('content')
<form action="{{ route('units.update', ['unit' => $unit->id]) }}" method="POST">
    @csrf @method('PATCH')
    <div>Name: <input type="text" name="name" id="name" value="{{ $unit->name }}"></div>
    @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
    <div><input type="submit" class="btn" value="Edit"></div>
    <a href="{{ route('units.index') }}" class="btn btn-secondary">Cancel</a>
    {{-- CATEGORY --}}
</form>
@endsection
