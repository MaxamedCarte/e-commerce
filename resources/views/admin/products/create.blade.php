@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-3">Add Product</h1>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @include('admin.products._form', ['product' => new \App\Models\Product()])
            </form>
        </div>
    </div>
@endsection
