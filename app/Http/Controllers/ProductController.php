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

        $favoriteProductIds = auth()->check()
            ? auth()->user()->favorites()->pluck('products.id')->all()
            : [];

        return view('products.index', compact('products', 'categories', 'categoryId', 'search', 'favoriteProductIds'));
    }

    public function show(Product $product)
    {
        $isFavorited = auth()->check()
            ? auth()->user()->favorites()->where('products.id', $product->id)->exists()
            : false;

        return view('products.show', compact('product', 'isFavorited'));
    }

    public function featured()
    {
        $products = Product::inRandomOrder()->take(8)->get();

        return view('products.featured', compact('products'));
    }


}
