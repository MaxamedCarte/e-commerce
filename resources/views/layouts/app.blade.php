<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'E-Commerce') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar-brand { font-weight: 700; letter-spacing: 0.5px; }
        .card { transition: transform 0.2s, box-shadow 0.2s; border: none; shadow-sm; }
        .card:hover { transform: translateY(-3px); box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .btn-primary { background-color: #0d6efd; border: none; }
        .btn-primary:hover { background-color: #0b5ed7; }
        footer { background: #212529; color: #adb5bd; padding: 3rem 0; margin-top: auto; }
        .min-vh-80 { min-height: 80vh; }
    </style>
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow">
    <div class="container">
        <a class="navbar-brand" href="{{ route('products.index') }}"><i class="bi bi-shop me-2"></i>Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Products</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}">Cart</a></li>
                @auth
                    @if (auth()->user()->is_admin)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Admin Panel</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('admin.products.index') }}">Products</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.categories.index') }}">Categories</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.orders.index') }}">Orders</a></li>
                            </ul>
                        </li>
                    @endif
                @endauth
            </ul>
            <ul class="navbar-nav">
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="nav-item me-2">
                        <span class="navbar-text text-white">Hi, {{ auth()->user()->name }}</span>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('auth.logout') }}">
                            @csrf
                            <button class="btn btn-outline-light btn-sm">Logout</button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<main class="container py-4">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @yield('content')
</main>

<footer class="mt-auto">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <h5>Shop</h5>
                <p class="small">Premium products for your lifestyle. High quality, great prices.</p>
            </div>
            <div class="col-md-4 mb-3">
                <h5>Links</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('products.index') }}" class="text-decoration-none text-muted">Home</a></li>
                    <li><a href="#" class="text-decoration-none text-muted">About Us</a></li>
                    <li><a href="#" class="text-decoration-none text-muted">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-3">
                <h5>Contact</h5>
                <p class="small"><i class="bi bi-geo-alt me-2"></i> 123 E-commerce St, City, Country</p>
                <p class="small"><i class="bi bi-envelope me-2"></i> support@example.com</p>
            </div>
        </div>
        <hr>
        <div class="text-center small">
            &copy; {{ date('Y') }} {{ config('app.name', 'E-Commerce') }}. All rights reserved.
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
