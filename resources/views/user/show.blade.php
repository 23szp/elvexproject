@extends('layouts.app')

@section('title', $user->name . ' profilja')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
    <div class="text-center">
<img src="{{ $user->profile_image ? asset('public/storage/' . $user->profile_image) : 'https://www.gravatar.com/avatar/' . md5($user->email) . '?d=mp' }}" 
     alt="{{ $user->name }}" 
     class="w-32 h-32 rounded-full mx-auto mb-4">
        <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
    </div>

    <div class="mt-8">
        <h3 class="text-xl font-bold text-gray-800 mb-6">{{ $user->name }} hirdetései</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>

        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection