@extends('layouts.dashboard')

@section('content')
    <div class="p-6 text-gray-900">
        {{ __("You're logged in!") }}
    </div>
    <x-product-list/>
@endsection
