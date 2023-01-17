@extends('layouts.dashboard')

@section('title')
    Edit order: {{ $order->created_at }} by {{ $order->user->name }}
@endsection

@section('content')
    <div class="p-6 max-w-5xl mx-auto">
        <div class="text-xl font-bold">Order Details</div>
        <div class="py-5">
            <div>Name: {{ $order->user->name }}</div>
            <div>Ordered at: {{ $order->created_at }}</div>
            <div>Status:
                <form action="/orders/{{ $order->id }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <select name="status" id="status">
                        @foreach ($orderstatusses as $orderstatus)
                            <option @if($orderstatus->id == $order->status->id) selected @endif value="{{ $orderstatus->id }}">{{ $orderstatus->name }}</option>
                        @endforeach
                    </select>
                    <input type="submit" value="Edit" class="btn">
                </form>
            </div>
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
    </div>
@endsection
