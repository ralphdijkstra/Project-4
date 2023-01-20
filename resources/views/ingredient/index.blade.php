@extends('layouts.dashboard')

@section('title')
    Ingredients
@endsection

@section('content')
    @foreach ($ingredients as $ingredient)
  
    <div>  {{ $ingredient->name }}
        <a href="{{ route('ingredients.edit', ['ingredient' => $ingredient->id]) }}">
           <input type="submit" class="btn" value="Edit"></a>
        <a href="{{ route('ingredients.delete', ['id' => $ingredient->id]) }}">
           <input type="submit" class="btn btn-warning" value="Delete"></a>
    </div>
   
    @endforeach
    <div> 
    <a href="{{ route('ingredients.create') }}">
    <input type="submit" class="btn" value="Create"></a>
    </div>
@endsection


