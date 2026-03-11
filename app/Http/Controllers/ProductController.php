<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController
{
    use App\Models\Product;

    public function index()
    {
        $products = Product::with('category')->get();

        return view('products.index', compact('products'));
    }
}
