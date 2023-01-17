@extends('layouts.dashboard')

@section('title')
    Manage Orders
@endsection

@section('content')
    <div class="grid grid-cols-3 max-w-2xl mx-auto">
        {{-- Headers --}}
        <div class="font-bold">Name</div>
        <div class="font-bold">Date</div>
        <div class="font-bold">Status</div>
        {{-- End of headers --}}
        @foreach ($orders as $order)
        <a href="{{ route('orders.show', ['id' => $order->id]) }}" class="grid grid-cols-3 col-span-3 hover:bg-slate-300">
            <div>{{ $order->user->name }}</div>
            <div>{{ $order->created_at }}</div>
            <div>{{ $order->status->name }}</div>
        </a>
        @endforeach
    </div>
@endsection
