<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Product $product)
    {
        $cartItems = session()->get('cart', []);
        $cartItems[$product->id] = [
            'product' => $product,
            'quantity' => isset($cartItems[$product->id]) ? $cartItems[$product->id]['quantity'] + 1 : 1,
        ];
        session()->put('cart', $cartItems);

        return back();
    }
}
