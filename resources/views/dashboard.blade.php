@extends('layouts.dashboard')

@section('content')
    @if(session()->has('success'))
    <div class="p-3 text-green-900 bg-green-300 rounded-md">
        {{Session::get('success')}}
    </div>
    @endif
    <x-product-list/>
@endsection
