@extends('layouts.dashboard')

@section('title')
    Units
@endsection

@section('content')
    @foreach ($units as $unit)
  

    <div>  {{ $unit->name }}
        <a href="{{ route('units.edit', ['unit' => $unit->id]) }}">
           <input type="submit" class="btn" value="Edit"></a>
        <a href="{{ route('units.delete', ['id' => $unit->id]) }}">
           <input type="submit" class="btn btn-warning" value="Delete"></a>
    </div>
   
    @endforeach
    <div> 
    <a href="{{ route('units.create') }}">
    <input type="submit" class="btn" value="Create"></a>
    </div>
@endsection


