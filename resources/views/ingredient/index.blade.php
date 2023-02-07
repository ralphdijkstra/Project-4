@extends('layouts.dashboard')

@section('title')
    Ingredients
@endsection

@section('content')
    @foreach ($ingredients as $ingredient)
   
    <div class="grid grid-cols-4 mb-1">  {{ $ingredient->name }}
      <div>
        <a href="{{ route('ingredients.edit', ['ingredient' => $ingredient->id]) }}">
           <input type="submit" class="btn" value="Edit"></a>
        <a href="{{ route('ingredients.delete', ['id' => $ingredient->id]) }}">
           <input type="submit" class="btn btn-warning" value="Delete"></a>
      </div>
    </div>
   
    @endforeach
    <div> 
    <a href="{{ route('ingredients.create') }}">
    <input type="submit" class="btn" value="Create"></a>
    </div>
@endsection


