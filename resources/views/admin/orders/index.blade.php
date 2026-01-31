@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="h3 mb-4">Manage Orders</h1>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Order ID</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-end pe-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td class="ps-4">#{{ $order->id }}</td>
                        <td>
                            <div>{{ $order->user->name }}</div>
                            <small class="text-muted">{{ $order->user->email }}</small>
                        </td>
                        <td>${{ number_format($order->total_price, 2) }}</td>
                        <td><span class="badge bg-warning text-dark">{{ ucfirst($order->status) }}</span></td>
                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
