@extends('layouts.app')

@section('title', 'Termékek')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Összes termék</h1>
        @auth
            <a href="{{ route('products.create') }}" 
               class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-500 transition">
                Új termék feltöltése
            </a>
        @endauth
    </div>

    @if($products->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ Storage::url($product->image) }}" 
                         alt="{{ $product->title }}" 
                         class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $product->title }}</h3>
                        <p class="text-purple-600 font-bold mt-2">{{ number_format($product->price, 0, ',', ' ') }} Ft</p>
                        <p class="text-gray-600 text-sm mt-2">{{ Str::limit($product->description, 100) }}</p>
                        
                        <div class="mt-3">
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">
                                @switch($product->condition)
                                    @case('new')
                                        Új
                                        @break
                                    @case('like_new')
                                        Újszerű
                                        @break
                                    @case('good')
                                        Jó
                                        @break
                                    @case('fair')
                                        Megfelelő
                                        @break
                                @endswitch
                            </span>
                        </div>

                        <div class="mt-4 flex justify-between items-center">
                            <div class="flex items-center">
                                <img class="h-8 w-8 rounded-full object-cover" 
                                     src="https://www.gravatar.com/avatar/{{ md5($product->user->email) }}?d=mp" 
                                     alt="{{ $product->user->name }}">
                                <span class="ml-2 text-sm text-gray-600">{{ $product->user->name }}</span>
                            </div>
                            <a href="{{ route('products.show', $product) }}" 
                               class="text-purple-600 hover:text-purple-500">
                                Részletek
                            </a>
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
            <p class="text-gray-600 text-lg">Még nincsenek feltöltött termékek.</p>
            @auth
                <a href="{{ route('products.create') }}" 
                   class="inline-block mt-4 bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-500 transition">
                    Tölts fel egy terméket!
                </a>
            @endauth
        </div>
    @endif
</div>
@endsection