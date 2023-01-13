@extends('layouts.dashboard')

@section('content')
<table id="cart" class="table table-hover table-condensed">
    <thead>
        <tr>
            <th style="width:50%">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
    </thead>
    <tbody>
        <?php $total = 0; ?>
        {{Session::get('success')}}
        
        @if (session('cart'))
            @foreach (session('cart') as $id => $details)
                <?php $total += $details['price'] * $details['quantity']; ?>
                <tr>
                    <td data-th="Product">
                        <div class="row">
                            {{-- <div class="col-sm-3 hidden-xs"><img src="{{ $details['photo'] }}" width="100" height="100" class="img-responsive"/></div> --}}
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $details['name'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">€{{ $details['price'] }}</td>
                    <td data-th="Quantity">
                        <form method="POST" action="{{ route('product.refresh') }}">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="id" value="{{ $id }}">
                            <input type="number" name="quantity" value="{{ $details['quantity'] }}" />
                    </td>
                    <td data-th="Subtotal" class="text-center">€{{ $details['price'] * $details['quantity'] }}</td>
                    <td class="actions" data-th="">
                        <input type="submit" value="Refresh" />
                        </form>
                        <form method="POST" action="{{ route('product.remove') }}">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="id" value="{{ $id }}">
                            <input type="hidden" name="quantity" value="{{ $details['quantity'] }} ">
                            <input type="submit" value="Delete" />
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr>
            <td><a href="{{ route('dashboard') }} " class="btn"><i class="fa fa-angle-left"></i> Continue
                    Shopping</a></td>
            <td colspan="2" class="hidden-xs"></td>
            <td class="hidden-xs text-center"><strong>Total €{{ $total }}</strong></td>
        </tr>
    </tfoot>
</table>
@endsection
