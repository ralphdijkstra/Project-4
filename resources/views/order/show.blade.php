@extends('layouts.dashboard')

@section('title')
    Order: {{ $order->created_at }}
@endsection

@section('content')
    <div class="w-full text-right pt-6 pr-6">
        <a href="{{ route('orders.edit', ['id' => $order->id]) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
    </div>
    <div class="px-6 pb-12 max-w-5xl mx-auto">
        <div class="text-xl font-bold">Order Details</div>
        <div class="py-5">
            @isset($order->user->name)
                <div>Name: {{ $order->user->name }}</div>
            @else
                <div>Name: {{ $order->guest_name }}</div>
            @endisset
            <div>Address: {{ $order->address }}, {{ $order->postal_code }} {{ $order->city }}</div>
            <div>Ordered at: {{ $order->created_at }}</div>
            <div>Status: {{ $order->status->name }}</div>
        </div>
        <div class="text-xl font-bold">Order Items</div>
        <div class="grid grid-cols-5 py-5">
            <div class="font-bold">Name</div>
            <div class="font-bold">Price</div>
            <div class="font-bold">Size</div>
            <div class="font-bold">Quantity</div>
            <div class="font-bold">Subtotal</div>
            <?php $total = 0; ?>
            @foreach ($orderitems as $item)
                <?php $subtotal = $item->price * $item->quantity;
                $total += $subtotal; ?>
                <div>{{ $item->product->name }}</div>
                <div>€ {{ number_format($item->price, 2) }}</div>
                <div>{{ $item->size }} cm</div>
                <div>{{ $item->quantity }}</div>
                <div>€ {{ number_format($subtotal, 2) }}</div>
            @endforeach
        </div>
        <div>Total: € {{ number_format($total, 2) }}</div>
        <form class="py-3" action="/orders/{{ $order->id }}" method="POST">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status" value="5">
            <div class="flex flex-row items-center">
                @if ($order->status->id === 1)
                    <input class="btn btn-warning" type="submit" value="Cancel">
                @else
                    <input class="btn btn-invalid" type="button" value="Cancel">
                @endif
                <p class="italic text-gray-500 p-5">Je kan je order alleen annuleren als deze nog bereid word</p>
            </div>
        </form>
    </div>
@endsection
