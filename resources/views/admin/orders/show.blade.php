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
                @php
                    $statusMeta = [
                        'pending' => [
                            'label' => 'Pending Payment',
                            'badge' => 'bg-warning text-dark',
                            'icon' => 'bi-hourglass-split',
                            'description' => 'Awaiting payment confirmation.',
                        ],
                        'processing' => [
                            'label' => 'Processing',
                            'badge' => 'bg-info text-dark',
                            'icon' => 'bi-gear-wide-connected',
                            'description' => 'Order is being prepared.',
                        ],
                        'shipped' => [
                            'label' => 'Shipped',
                            'badge' => 'bg-primary',
                            'icon' => 'bi-truck',
                            'description' => 'Package is on the way.',
                        ],
                        'delivered' => [
                            'label' => 'Delivered',
                            'badge' => 'bg-success',
                            'icon' => 'bi-check-circle',
                            'description' => 'Delivered to customer.',
                        ],
                        'cancelled' => [
                            'label' => 'Cancelled',
                            'badge' => 'bg-danger',
                            'icon' => 'bi-x-circle',
                            'description' => 'Order was cancelled.',
                        ],
                    ];

                    $meta = $statusMeta[$order->status] ?? [
                        'label' => ucfirst($order->status),
                        'badge' => 'bg-secondary',
                        'icon' => 'bi-info-circle',
                        'description' => 'Status updated.',
                    ];
                @endphp
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
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <span class="text-muted">Status:</span>
                        <span class="badge {{ $meta['badge'] }}">
                            <i class="bi {{ $meta['icon'] }} me-1"></i>{{ $meta['label'] }}
                        </span>
                    </div>
                    <div class="text-muted small mt-2">{{ $meta['description'] }}</div>

                    <form method="POST" action="{{ route('admin.orders.status.update', $order) }}" class="mt-3">
                        @csrf
                        @method('PATCH')
                        <div class="input-group">
                            <select name="status" class="form-select">
                                <option value="pending" @selected($order->status === 'pending')>Pending Payment</option>
                                <option value="processing" @selected($order->status === 'processing')>Processing</option>
                                <option value="shipped" @selected($order->status === 'shipped')>Shipped</option>
                                <option value="delivered" @selected($order->status === 'delivered')>Delivered</option>
                                <option value="cancelled" @selected($order->status === 'cancelled')>Cancelled</option>
                            </select>
                            <button class="btn btn-outline-primary">Update</button>
                        </div>
                        @error('status')<div class="text-danger small mt-2">{{ $message }}</div>@enderror
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
