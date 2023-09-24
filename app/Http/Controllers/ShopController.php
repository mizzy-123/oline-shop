<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $category = Category::orderBy('name', 'asc')->get();
        if (request('orderPrice')) {
            $product = Product::filter(request(['price', 'category', 'search', 'orderPrice']))->paginate(9)->withQueryString();
            // return dd($product);
            return view('main.pages.shop', [
                'product' => $product,
                'category' => $category
            ]);
        } else {
            $product = Product::latest()->filter(request(['price', 'category', 'search', 'orderPrice']))->paginate(9)->withQueryString();
            // return dd($product);
            return view('main.pages.shop', [
                'product' => $product,
                'category' => $category
            ]);
        }
    }

    public function show(Product $product)
    {
        return view('main.pages.product', [
            'product' => $product
        ]);
    }
}
