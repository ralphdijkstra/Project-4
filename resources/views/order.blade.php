@extends('layouts.dashboard')

@section('title')
    Order
@endsection

@section('content')
    @if (session()->has('success'))
    <div class="m-1 p-3 text-green-500 bg-green-200 rounded-md">
            {{ Session::get('success') }}
    </div>
    @endif
    <x-product-list />
@endsection
