@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Add Product</h1>
        <a class="btn btn-outline-secondary" href="{{ route('admin.products.index') }}">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @include('admin.products._form', ['product' => new \App\Models\Product()])
            </form>
        </div>
    </div>
@endsection
