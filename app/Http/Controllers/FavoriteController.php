<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;

class FavoriteController extends Controller

{
    public function store(Product $product): RedirectResponse
    {
        $user = request()->user();
        $user->favorites()->syncWithoutDetaching([$product->id]);

        return back();
    }

    public function destroy(Product $product): RedirectResponse
    {
        $user = request()->user();
        $user->favorites()->detach($product->id);

        return back();
    }
}
