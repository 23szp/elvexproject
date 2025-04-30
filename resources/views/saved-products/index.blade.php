@extends('layouts.app')

@section('title', 'Mentett termékek')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Mentett termékek</h1>

    @if($savedProducts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($savedProducts as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>

        <div class="mt-8">
            {{ $savedProducts->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <p class="text-gray-600 text-lg">Még nincsenek mentett termékeid.</p>
        </div>
    @endif
</div>
@endsection
