<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty.');
        }

        $total = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);

        return view('checkout.index', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty.');
        }

        foreach ($cart as $item) {
            $product = Product::find($item['product_id']);

            if (! $product || $product->stock < $item['quantity']) {
                return redirect()->route('cart.index')
                    ->with('error', "Not enough stock for {$item['name']}.");
            }
        }

        $order = DB::transaction(function () use ($cart, $request) {
            $total = 0;

            $order = Order::create([
                'user_id' => $request->user()->id,
                'total_price' => 0,
                'status' => 'pending',
            ]);

            foreach ($cart as $item) {
                $product = Product::lockForUpdate()->findOrFail($item['product_id']);

                $product->decrement('stock', $item['quantity']);

                $lineTotal = $item['price'] * $item['quantity'];
                $total += $lineTotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            $order->update(['total_price' => $total]);

            return $order;
        });

        session()->forget('cart');

        return view('orders.confirmation', ['order' => $order]);
    }
}
