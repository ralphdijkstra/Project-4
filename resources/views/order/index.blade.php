@extends('layouts.dashboard')

@section('title')
    Orders
@endsection

@section('content')
    <div class="grid grid-cols-2">
        {{-- Headers --}}
        <div class="font-bold">Date</div>
        <div class="font-bold">Status</div>
        {{-- End of headers --}}
        @foreach ($orders as $order)
            <div><a href="{{ route('orders.show', ['id' => $order->id]) }}">{{ $order->created_at }}</a></div>
            <div>{{ $order->status->name }}</div>
        @endforeach
    </div>
@endsection
