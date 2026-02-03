@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="card shadow-sm border-0 overflow-hidden">
        <div class="row g-0">
            <div class="col-md-6 bg-light d-flex align-items-center justify-content-center p-4">
                @if ($product->image)
                    <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : Storage::url($product->image) }}" class="img-fluid rounded shadow-sm" style="max-height: 400px;" alt="{{ $product->name }}">
                @else
                    <div class="text-secondary text-center">
                        <i class="bi bi-camera fs-1 display-1"></i>
                        <p class="mt-2">No Image Available</p>
                    </div>
                @endif
            </div>
            <div class="col-md-6">
                <div class="card-body p-5 position-relative">
                    @auth
                        <form method="POST" action="{{ $isFavorited ? route('favorites.destroy', $product) : route('favorites.store', $product) }}" class="position-absolute top-0 end-0 me-4 mt-4">
                            @csrf
                            @if ($isFavorited)
                                @method('DELETE')
                            @endif
                            <button type="submit" class="btn btn-light btn-sm shadow-sm" aria-label="{{ $isFavorited ? 'Remove from favorites' : 'Add to favorites' }}">
                                <i class="bi {{ $isFavorited ? 'bi-heart-fill text-danger' : 'bi-heart' }}"></i>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('register') }}" class="position-absolute top-0 end-0 me-4 mt-4 btn btn-light btn-sm shadow-sm" aria-label="Register to add favorites">
                            <i class="bi bi-heart"></i>
                        </a>
                    @endauth
                    <span class="badge bg-secondary mb-2">{{ $product->category?->name }}</span>
                    <h1 class="display-5 fw-bold mb-3">{{ $product->name }}</h1>
                    <h3 class="text-primary mb-4">${{ number_format($product->price, 2) }}</h3>

                    <p class="lead text-muted mb-4">{{ $product->description }}</p>

                    <div class="mb-4">
                        @if ($product->stock > 0)
                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> In Stock ({{ $product->stock }})</span>
                        @else
                            <span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i> Out of Stock</span>
                        @endif
                    </div>

                    <form method="POST" action="{{ route('cart.store', $product) }}" class="row g-3 align-items-center">
                        @csrf
                        <div class="col-auto">
                            <label for="quantity" class="visually-hidden">Quantity</label>
                            <input type="number" name="quantity" id="quantity" min="1" max="{{ $product->stock }}" value="1" class="form-control form-control-lg" style="width: 100px;">
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-primary btn-lg px-5" {{ $product->stock < 1 ? 'disabled' : '' }}>
                                <i class="bi bi-cart-plus me-2"></i> Add to Cart
                            </button>
                        </div>
                    </form>

                    <hr class="my-5">

                    <div class="small text-muted">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-truck me-3 fs-5"></i> Free Shipping on orders over $50
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-shield-check me-3 fs-5"></i> 2 Year Warranty
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
