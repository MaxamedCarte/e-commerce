@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-3">Edit Product</h1>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
                @method('PUT')
                @include('admin.products._form', ['product' => $product])
            </form>
        </div>
    </div>
@endsection
