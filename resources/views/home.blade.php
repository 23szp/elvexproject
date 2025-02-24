@extends('layouts.app')

@section('title', 'Kezdőlap')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @foreach($products as $product)
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->title }}" class="w-full h-48 object-cover">
        <div class="p-4">
            <h3 class="text-lg font-semibold text-gray-800">{{ $product->title }}</h3>
            <p class="text-purple-600 font-bold mt-2">{{ number_format($product->price, 0, ',', ' ') }} Ft</p>
            <p class="text-gray-600 text-sm mt-2">{{ Str::limit($product->description, 100) }}</p>
            <div class="mt-4 flex justify-between items-center">
                <span class="text-sm text-gray-500">{{ $product->user->name }}</span>
                <a href="{{ route('products.show', $product) }}" class="text-purple-600 hover:text-purple-500">Részletek</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="mt-8">
    {{ $products->links() }}
</div>
@endsection