@extends('layouts.app')

@section('title', 'Felhasználó hirdetései')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">{{ $user->name }} hirdetései</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($products as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
<img src="{{ asset('public/storage/' . $product->image) }}" 
     alt="{{ $product->title }}" 
     class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $product->title }}</h3>
                    <p class="text-purple-600 font-bold mt-2">{{ number_format($product->price, 0, ',', ' ') }} Ft</p>
                    <p class="text-gray-600 text-sm mt-2">{{ Str::limit($product->description, 100) }}</p>
                    
                    <a href="{{ route('products.edit', $product) }}" class="text-blue-600 hover:text-blue-500">
                        Szerkesztés
                    </a>

                    <form action="{{ route('admin.products.delete', $product) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-500">
                            Törlés
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection