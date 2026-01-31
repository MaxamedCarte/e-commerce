<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categoryId = $request->query('category');
        $search = $request->query('search');

        $categories = Category::orderBy('name')->get();

        $products = Product::with('category')
            ->when($categoryId, fn ($query) => $query->where('category_id', $categoryId))
            ->when($search, fn ($query) => $query->where('name', 'like', "%{$search}%"))
            ->orderByDesc('id')
            ->paginate(9)
            ->withQueryString();

        return view('products.index', compact('products', 'categories', 'categoryId', 'search'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
