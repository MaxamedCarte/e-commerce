@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="mb-4">
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
                </div>
                <h1 class="display-5 fw-bold mb-3">Thank You for Your Order!</h1>
                <p class="lead text-muted mb-4">Your order #{{ $order->id }} has been placed successfully.</p>
                
                <div class="card shadow-sm text-start mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th class="text-end">Qty</th>
                                        <th class="text-end">Price</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td>{{ $item->product->name }}</td>
                                            <td class="text-end">{{ $item->quantity }}</td>
                                            <td class="text-end">${{ number_format($item->price, 2) }}</td>
                                            <td class="text-end">${{ number_format($item->price * $item->quantity, 2) }}</td>
                                        </tr>
                                    @endforeach
                                    <tr class="border-top">
                                        <td colspan="3" class="fw-bold text-end">Total</td>
                                        <td class="fw-bold text-end">${{ number_format($order->total_price, 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg px-5">Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>
@endsection
