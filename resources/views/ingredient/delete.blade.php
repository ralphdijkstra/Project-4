@extends('layouts.dashboard')

@section('title')
    Delete
@endsection

@section('content')
<form action="{{ route('ingredients.destroy', ['ingredient' => $ingredient->id]) }}" method="post">
    @csrf
    @method('DELETE')
    <div class="form-group">
        <label for="">Are you sure you want to delete {{ $ingredient->name }}?</label>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-danger" value="Delete">
        <a href="{{ route('ingredients.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection