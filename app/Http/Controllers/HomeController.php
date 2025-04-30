<?php

namespace App\Http\Controllers;
<<<<<<< HEAD
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('user', 'category')->where('is_available', true);
    
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }
    
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%') 
                  ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }
    
  
        $perPage = $request->input('per_page', 12);
        

        if ($perPage === 'all') {
            $products = $query->latest()->get();
   
            $products = new \Illuminate\Pagination\LengthAwarePaginator(
                $products,
                $products->count(),
                $products->count(),
                1, 
                ['path' => $request->url(), 'query' => $request->query()]
            );
        } else {
            $products = $query->latest()->paginate((int)$perPage);

            $products->appends($request->except('page'));
        }
    
        $categories = Category::whereNull('parent_id')->with('children')->get();
    
        return view('home', compact('products', 'categories'));
=======

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
>>>>>>> 4ecec8f1306eb8bbd1979d39463d687569b2f169
    }
}