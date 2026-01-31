@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-3">Your Cart</h1>

    @if (empty($cart))
        <div class="alert alert-info">Your cart is empty.</div>
        <a class="btn btn-primary" href="{{ route('products.index') }}">Continue shopping</a>
    @else
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th style="width: 160px;">Quantity</th>
                    <th>Total</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @php $grandTotal = 0; @endphp
                @foreach ($cart as $item)
                    @php $lineTotal = $item['price'] * $item['quantity']; $grandTotal += $lineTotal; @endphp
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>${{ number_format($item['price'], 2) }}</td>
                        <td>
                            <form method="POST" action="{{ route('cart.update') }}" class="d-flex gap-2">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                <input type="number" name="quantity" min="1" value="{{ $item['quantity'] }}" class="form-control">
                                <button class="btn btn-outline-secondary btn-sm">Update</button>
                            </form>
                        </td>
                        <td>${{ number_format($lineTotal, 2) }}</td>
                        <td>
                            <form method="POST" action="{{ route('cart.destroy') }}">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                <button class="btn btn-outline-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <h4>Grand Total: ${{ number_format($grandTotal, 2) }}</h4>
            <a class="btn btn-success" href="{{ route('checkout.index') }}">Proceed to Checkout</a>
        </div>
    @endif
@endsection
