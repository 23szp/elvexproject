@extends('layouts.app')

<<<<<<< HEAD
@section('title', 'Kezdőlap')

@section('content')

<div class="container mx-auto px-4">
<div class="mb-12">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Böngéssz kategóriák szerint</h2>
    
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4">
        @foreach($categories as $category)
        <div x-data="{ open: false }" class="relative">
            <button
                @click="open = !open"
                class="w-full bg-white border border-gray-200 text-gray-800 font-medium py-4 px-3 rounded-lg shadow-sm hover:shadow-md hover:border-purple-300 transition duration-300 flex flex-col items-center justify-center h-32"
            >
                <div class="text-purple-600 mb-2">
                    @if(strtolower($category->name) == 'ruházat' || strtolower($category->name) == 'divat')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    @elseif(strtolower($category->name) == 'férfi')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    @elseif(strtolower($category->name) == 'női')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    @elseif(strtolower($category->name) == 'elektronika' || strtolower($category->name) == 'műszaki cikkek')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    @elseif(strtolower($category->name) == 'otthon' || strtolower($category->name) == 'lakberendezés' || strtolower($category->name) == 'otthon és kert')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    @elseif(strtolower($category->name) == 'sport' || strtolower($category->name) == 'szabadidő')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    @elseif(strtolower($category->name) == 'játék' || strtolower($category->name) == 'gyerek')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    @elseif(strtolower($category->name) == 'jármű' || strtolower($category->name) == 'autó')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    @elseif(strtolower($category->name) == 'autó és motor')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    @elseif(strtolower($category->name) == 'könyvek' || strtolower($category->name) == 'könyv')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    @elseif(strtolower($category->name) == 'szépségápolás' || strtolower($category->name) == 'szépség és egészség')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    @elseif(strtolower($category->name) == 'étel és ital' || strtolower($category->name) == 'élelmiszer')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    @endif
                </div>
                <span class="text-center">{{ $category->name }}</span>
            </button>

            <div
                x-show="open"
                @click.away="open = false"
                class="absolute left-0 md:left-auto md:right-0 top-full mt-2 w-full md:w-64 bg-white border border-gray-200 rounded-lg shadow-lg z-50 p-3"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
                style="z-index: 50;"
            >
                <div class="flex justify-between items-center mb-2 pb-1 border-b">
                    <h4 class="font-semibold text-purple-700">{{ $category->name }}</h4>
                    <button @click="open = false" class="text-gray-500 hover:text-gray-700 focus:outline-none md:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <ul class="space-y-1 max-h-60 overflow-y-auto">
                    @foreach($category->children as $child)
                        <li>
                            <a
                                href="{{ route('home', ['category' => $child->id]) }}"
                                class="block px-3 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-700 rounded transition duration-200"
                            >
                                {{ $child->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endforeach
    </div>
</div>
</div>


    <div class="mb-12">
        <div class="flex justify-between items-center border-b pb-2 mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Legújabb hirdetések</h2>
            
            <form action="{{ route('home') }}" method="GET" class="flex items-center space-x-2">
                @if(request()->has('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                
                <label for="per_page" class="text-gray-600 text-sm">Hirdetések oldalanként:</label>
                <select name="per_page" id="per_page" onchange="this.form.submit()" 
                        class="form-select bg-white border border-gray-300 text-gray-700 py-1 px-3 pr-8 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 text-sm">
  <option value="12" {{ request('per_page') == 12 || !request('per_page') ? 'selected' : '' }}>12</option>
        <option value="24" {{ request('per_page') == 24 ? 'selected' : '' }}>24</option>
        <option value="36" {{ request('per_page') == 36 ? 'selected' : '' }}>36</option>
        <option value="48" {{ request('per_page') == 48 ? 'selected' : '' }}>48</option>
        <option value="all" {{ request('per_page') == 'all' ? 'selected' : '' }}>Összes</option>
                </select>
            </form>
        </div>

        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>

            <div class="mt-8">
                {{ $products->appends(['per_page' => request('per_page'), 'category' => request('category')])->links() }}
            </div>
        @else
            <div class="text-center py-16 bg-gray-50 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
                <p class="text-gray-600 text-lg mb-4">Még nincsenek feltöltött hirdetések.</p>
                @auth
                    <a href="{{ route('products.create') }}" 
                    class="inline-block mt-2 bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-500 transition duration-300 font-medium">
                        Tölts fel egy hirdetést!
                    </a>
                @endauth
            </div>
        @endif
    </div>
=======
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
>>>>>>> 4ecec8f1306eb8bbd1979d39463d687569b2f169
</div>
@endsection