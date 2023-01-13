@extends('layouts.dashboard')

@section('title')
    Menu
@endsection

@section('content')
    @if (session()->has('success'))
        <div class="p-3 text-green-900 bg-green-300 rounded-md">
            {{ Session::get('success') }}
        </div>
    @endif
@endsection
