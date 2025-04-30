<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('user', 'category')->where('is_available', true)->latest()->paginate(12);
        $categories = Category::whereNull('parent_id')->with('children')->get();
        return view('products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')->get(); 
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0|max:999999999',
            'condition' => 'required',
            'images' => 'required|array|min:1',
            'images.*' => 'image|max:200000',
            'category_id' => 'required|exists:categories,id',
            'email' => 'required|email|max:255', 
            'phone' => 'nullable|string|max:20', 
        ]);


        $product = auth()->user()->products()->create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'condition' => $validated['condition'],
            'image' => null, 
            'category_id' => $validated['category_id'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
        ]);

   
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                
       
                $product->images()->create([
                    'image' => $path
                ]);
            }
            

            $firstImage = $product->images()->first();
            if ($firstImage) {
                $product->update(['image' => $firstImage->image]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Termék sikeresen létrehozva!');
    }

    public function edit(Product $product)
    {
    
        if (Auth::user()->is_admin || $product->user_id === Auth::id()) {
            $categories = Category::whereNull('parent_id')->get(); 
            return view('products.edit', compact('product', 'categories'));
        }

        abort(403, 'Nincs jogosultságod a hirdetés szerkesztéséhez.');
    }

    public function update(Request $request, Product $product)
    {
     
        if (Auth::user()->is_admin || $product->user_id === Auth::id()) {
            $validated = $request->validate([
                'title' => 'required|max:255',
                'description' => 'required',
                'price' => 'required|numeric|min:0',
                'condition' => 'required',
                'new_images' => 'nullable|array',
                'new_images.*' => 'image|max:200000',
                'category_id' => 'required|exists:categories,id'
            ]);


            $product->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'condition' => $validated['condition'],
                'category_id' => $validated['category_id']
            ]);


            if ($request->hasFile('new_images')) {
                foreach ($request->file('new_images') as $image) {
                    $path = $image->store('products', 'public');
                    
           
                    $product->images()->create([
                        'image' => $path
                    ]);
                }
                
        
                if (!$product->image && $product->images()->count() > 0) {
                    $firstImage = $product->images()->first();
                    if ($firstImage) {
                        $product->update(['image' => $firstImage->image]);
                    }
                }
            }

          
            if ($request->has('delete_images')) {
                foreach ($request->delete_images as $imageId) {
                    $image = ProductImage::find($imageId);
                    if ($image && $image->product_id == $product->id) {
                     
                        Storage::disk('public')->delete($image->image);
                        
               
                        if ($product->image == $image->image) {
                            $newMainImage = $product->images()->where('id', '!=', $image->id)->first();
                            if ($newMainImage) {
                                $product->update(['image' => $newMainImage->image]);
                            } else {
                                $product->update(['image' => null]);
                            }
                        }
                        

                        $image->delete();
                    }
                }
            }

         
            if ($request->has('main_image')) {
                $mainImage = ProductImage::find($request->main_image);
                if ($mainImage && $mainImage->product_id == $product->id) {
                    $product->update(['image' => $mainImage->image]);
                }
            }

            return redirect()->route('products.show', $product)->with('success', 'Termék sikeresen frissítve!');
        }

        abort(403, 'Nincs jogosultságod a hirdetés frissítéséhez.');
    }

    public function show(Product $product)
    {
        $product->load('images');
        
        if (request()->ajax()) {
            return view('products.modal', compact('product'));
        }

        return view('products.show', compact('product'));
    }

    public function destroy(Product $product)
    {

        if (Auth::user()->is_admin || $product->user_id === Auth::id()) {
       
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image->image);
            }

         
            $product->delete();

            return redirect()->route('products.index')->with('success', 'Hírdetés sikeresen törölve!');
        }

        abort(403, 'Nincs jogosultságod a hirdetés törléséhez.');
    }
}
