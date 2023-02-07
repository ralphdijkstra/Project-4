@extends('layouts.dashboard')

@section('title')
    Dashboard
@endsection

@section('content')
    @auth
        <?php $total = 0; ?>
        <div>
            <p class="text-xl font-bold">Welcome, {{ Auth::user()->name }}</p>
            <p>You have
            @foreach (Auth::user()->person->pizzaPoint as $key => $value)
                <?php $total += $value['pizza_points']; ?>
            @endforeach
            {{ $total }}
            Pizza Points!</p>
            <p>And you have ordered {{ count(Auth::user()->orders) }} times!</p>
        </div>
    @endauth
@endsection
