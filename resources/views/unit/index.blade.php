@extends('layouts.dashboard')

@section('title')
    Units
@endsection

@section('content')
    @foreach ($units as $unit)
  

    <div class="grid grid-cols-4 mb-1">  {{ $unit->name }}
        <div>
        <a href="{{ route('units.edit', ['unit' => $unit->id]) }}">
           <input type="submit" class="btn" value="Edit"></a>
        <a href="{{ route('units.delete', ['id' => $unit->id]) }}">
           <input type="submit" class="btn btn-warning" value="Delete"></a>
       </div>
    </div>
   
    @endforeach
    <div> 
    <a href="{{ route('units.create') }}">
    <input type="submit" class="btn" value="Create"></a>
    </div>
@endsection


