@csrf

<div class="mb-3">
    <label class="form-label">Category</label>
    <select name="category_id" class="form-select" required>
        <option value="">Select category</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? null) == $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}" required>
    @error('name')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description ?? '') }}</textarea>
    @error('description')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Price</label>
    <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price ?? '') }}" required>
    @error('price')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Stock</label>
    <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock ?? 0) }}" required>
    @error('stock')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Image</label>
    <input type="file" name="image" class="form-control">
    @error('image')<div class="text-danger">{{ $message }}</div>@enderror
    @if (!empty($product?->image))
        <div class="mt-2">
            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" style="max-height: 120px;">
        </div>
    @endif
</div>

<button class="btn btn-primary">Save</button>
