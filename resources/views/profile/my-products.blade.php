@extends('layouts.app')

@section('title', 'Saját hirdetések')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Saját hirdetések</h1>

    @if($products->count() > 0)
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
                        
                        <div class="mt-4 flex justify-between items-center">
                            <a href="{{ route('products.edit', $product) }}" 
                               class="text-purple-600 hover:text-purple-500">
                                Szerkesztés
                            </a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-500"
                                        onclick="return confirm('Biztosan törölni szeretnéd ezt a hirdetést?')">
                                    Törlés
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $products->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <p class="text-gray-600 text-lg">Még nincsenek feltöltött hirdetéseid.</p>
            <a href="{{ route('products.create') }}" 
               class="inline-block mt-4 bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-500 transition">
                Tölts fel egy hirdetést!
            </a>
        </div>
    @endif
</div>
@endsection