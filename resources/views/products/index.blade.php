@extends('layouts.app')

@section('content')
    <div id="heroCarousel" class="carousel slide mb-5 shadow-sm rounded overflow-hidden" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" style="height: 400px;">
                <img src="https://images.unsplash.com/photo-1498049381961-a59a96975033?auto=format&fit=crop&w=1200&q=80" class="d-block w-100 h-100 object-fit-cover" alt="Latest Electronics">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                    <h5>Latest Electronics</h5>
                    <p>Upgrade your tech with our newest gadgets.</p>
                </div>
            </div>
            <div class="carousel-item" style="height: 400px;">
                <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=1200&q=80" class="d-block w-100 h-100 object-fit-cover" alt="Summer Collection">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                    <h5>Summer Collection</h5>
                    <p>Get ready for the season with stylish looks.</p>
                </div>
            </div>
            <div class="carousel-item" style="height: 400px;">
                <img src="https://images.unsplash.com/photo-1616486338812-3dadae4b4f9d?auto=format&fit=crop&w=1200&q=80" class="d-block w-100 h-100 object-fit-cover" alt="Home Essentials">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                    <h5>Home Essentials</h5>
                    <p>Transform your living space today.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div id="products" class="row align-items-center mb-4 pt-4 border-top">
        <div class="col-md-4">
            <h2 class="h3 fw-bold mb-0">Featured Products</h2>
        </div>
        <div class="col-md-8">
            <form method="GET" class="row g-2 justify-content-md-end">
                <div class="col-auto">
                    <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}">
                </div>
                <div class="col-auto">
                    <select name="category" class="form-select" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(request('category') == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if(request('search') || request('category'))
                <div class="col-auto">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
                @endif
            </form>
        </div>
    </div>

    <div class="mb-4">
        <a href="{{ route('products.featured') }}" class="btn btn-link">View All Featured Products</a>
    </div>

    <div class="row g-4">
        @forelse ($products as $product)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="position-relative">
                        @php $isFavorited = in_array($product->id, $favoriteProductIds ?? []); @endphp
                        @auth
                            <form method="POST" action="{{ $isFavorited ? route('favorites.destroy', $product) : route('favorites.store', $product) }}" class="position-absolute top-0 start-0 m-2">
                                @csrf
                                @if ($isFavorited)
                                    @method('DELETE')
                                @endif
                                <button type="submit" class="btn btn-light btn-sm shadow-sm" aria-label="{{ $isFavorited ? 'Remove from favorites' : 'Add to favorites' }}">
                                    <i class="bi {{ $isFavorited ? 'bi-heart-fill text-danger' : 'bi-heart' }}"></i>
                                </button>
                            </form>
                        @else
                            <a href="{{ route('register') }}" class="position-absolute top-0 start-0 m-2 btn btn-light btn-sm shadow-sm" aria-label="Register to add favorites">
                                <i class="bi bi-heart"></i>
                            </a>
                        @endauth
                        @if ($product->image)
                            <a href="{{ route('products.show', $product) }}" class="d-block">
                                <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : Storage::url($product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 240px; object-fit: cover;">
                            </a>
                        @else
                            <a href="{{ route('products.show', $product) }}" class="d-block">
                                <div class="bg-light text-secondary d-flex align-items-center justify-content-center" style="height: 240px;">
                                    <i class="bi bi-camera fs-1"></i>
                                </div>
                            </a>
                        @endif
                        <span class="position-absolute top-0 end-0 badge bg-primary m-2 shadow-sm">${{ number_format($product->price, 0) }}</span>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                             <span class="badge bg-secondary opacity-75 rounded-pill">{{ $product->category?->name }}</span>
                        </div>
                        <h5 class="card-title text-truncate" title="{{ $product->name }}">
                            <a href="{{ route('products.show', $product) }}" class="text-decoration-none text-dark">{{ $product->name }}</a>
                        </h5>
                        <p class="card-text text-muted small flex-grow-1">{{ Str::limit($product->description, 80) }}</p>
                        <div class="d-grid gap-2">
                            <form method="POST" action="{{ route('cart.store', $product) }}">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button class="btn btn-primary" {{ $product->stock < 1 ? 'disabled' : '' }}>
                                    <i class="bi bi-cart-plus me-2"></i> Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">No products available.</div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
@endsection
