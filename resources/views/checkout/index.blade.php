@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-3">Checkout</h1>

    <div class="card">
        <div class="card-body">
            <ul class="list-group mb-3">
                @foreach ($cart as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $item['name'] }}</strong>
                            <div class="text-muted">Qty: {{ $item['quantity'] }}</div>
                        </div>
                        <span>${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                    </li>
                @endforeach
            </ul>

            <h4>Total: ${{ number_format($total, 2) }}</h4>

            <form method="POST" action="{{ route('checkout.store') }}" class="mt-3">
                @csrf
                <button class="btn btn-primary">Place Order</button>
            </form>
        </div>
    </div>
@endsection
