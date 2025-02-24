@extends('layouts.app')

@section('title', $product->title)

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
    <!-- Sikeres művelet üzenet -->
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="md:flex">
        <div class="md:flex-shrink-0">
            <img class="h-64 w-full object-cover md:w-64" 
                 src="{{ Storage::url($product->image) }}" 
                 alt="{{ $product->title }}">
        </div>
        <div class="p-8">
            <div class="flex justify-between items-start">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">{{ $product->title }}</h2>
                    <p class="mt-2 text-purple-600 text-xl font-bold">
                        {{ number_format($product->price, 0, ',', ' ') }} Ft
                    </p>
                </div>
                @can('update', $product)
                    <div class="flex space-x-2">
                        <a href="{{ route('products.edit', $product) }}" 
                           class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-500 transition">
                            Szerkesztés
                        </a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-500 transition"
                                    onclick="return confirm('Biztosan törölni szeretnéd ezt a terméket?')">
                                Törlés
                            </button>
                        </form>
                    </div>
                @endcan
            </div>

            <p class="mt-4 text-gray-600">{{ $product->description }}</p>

            <div class="mt-4">
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

            <div class="mt-6 flex items-center">
                <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full bg-gray-200" 
                         src="https://www.gravatar.com/avatar/{{ md5($product->user->email) }}?d=mp" 
                         alt="{{ $product->user->name }}">
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">{{ $product->user->name }}</p>
                    <p class="text-sm text-gray-500">
                        Feltöltve: {{ $product->created_at->format('Y.m.d') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection