<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $product = Product::inRandomOrder()->take(8)->get();

        return view('main.pages.home', [
            'product' => $product
        ]);
    }
}
