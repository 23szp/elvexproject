<?php

<<<<<<< HEAD
Route::get('/search', function (Request $request) {
    $query = $request->input('query', '');
    
    if (strlen($query) < 2) {
        return response()->json(['results' => []]);
    }
    

    $results = \App\Models\Product::where('title', 'like', "%{$query}%")
        ->orWhere('description', 'like', "%{$query}%")
        ->orWhereHas('category', function ($q) use ($query) {
            $q->where('name', 'like', "%{$query}%");
        })
        ->with(['images', 'category'])
        ->orderByDesc('created_at')
        ->limit(10)
        ->get()
        ->map(function ($product) {
            return [
                'id' => $product->id,
                'title' => $product->title,
                'price' => number_format($product->price, 0, '.', ' '),
                'image' => $product->images->first() ? $product->images->first()->thumbnail_url : null,
                'url' => route('products.show', $product->id),
                'category' => $product->category ? $product->category->name : null
            ];
        });
    
    return response()->json(['results' => $results]);
})->name('api.search');
=======
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
>>>>>>> 4ecec8f1306eb8bbd1979d39463d687569b2f169
