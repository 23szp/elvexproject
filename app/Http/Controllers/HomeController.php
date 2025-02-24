<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('user')
            ->where('is_available', true)
            ->latest()
            ->paginate(12);
            
        return view('home', compact('products'));
    }
}