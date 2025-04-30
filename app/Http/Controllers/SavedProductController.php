<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SavedProductController extends Controller
{
  
    public function save(Product $product)
    {
        $user = auth()->user();

        if ($user->savedProducts()->where('product_id', $product->id)->exists()) {
            return back()->with('error', 'Ezt a terméket már elmentetted.');
        }

        $user->savedProducts()->attach($product->id);

        return back()->with('success', 'A terméket sikeresen elmentetted.');
    }


    public function unsave(Product $product)
    {
        $user = auth()->user();

        $user->savedProducts()->detach($product->id);

        return back()->with('success', 'A terméket eltávolítottad a mentettek közül.');
    }


    public function index()
    {
        $savedProducts = auth()->user()->savedProducts()->paginate(12);

        return view('saved-products.index', compact('savedProducts'));
    }
}
