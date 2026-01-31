@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Order #{{ $order->id }}</h1>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">Back to Orders</a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Order Items</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle">
                            <thead class="text-muted border-bottom">
                                <tr>
                                    <th>Product</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                <tr>
                                    <td>
                                        <div class="fw-bold">{{ $item->product->name }}</div>
                                    </td>
                                    <td class="text-center">${{ number_format($item->price, 2) }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-end fw-bold">${{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="border-top">
                                <tr>
                                    <td colspan="3" class="text-end fw-bold">Grand Total</td>
                                    <td class="text-end fw-bold fs-5">${{ number_format($order->total_price, 2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Customer Details</h5>
                </div>
                <div class="card-body">
                    <h6 class="fw-bold">{{ $order->user->name }}</h6>
                    <p class="mb-1"><a href="mailto:{{ $order->user->email }}" class="text-decoration-none">{{ $order->user->email }}</a></p>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Order Date:</span>
                        <span>{{ $order->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <span class="text-muted">Status:</span>
                         <span class="badge bg-warning text-dark">{{ ucfirst($order->status) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
