@extends('layouts.app')

@section('title', $product->title)

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
    <div class="relative">
        <div id="product-images-container" class="w-full h-[400px] flex items-center justify-center overflow-hidden">
            @if($product->images->count() > 0)
                @foreach($product->images as $index => $image)
                    <div class="product-image w-full h-full {{ $index === 0 ? 'block' : 'hidden' }}" data-index="{{ $index }}">
                        <img src="{{ asset('public/storage/' . $image->image) }}" 
                             alt="{{ $product->title }}" 
                             class="max-w-full max-h-full object-contain mx-auto">
                    </div>
                @endforeach
            @elseif($product->image)
                <div class="product-image w-full h-full block">
                    <img src="{{ asset('public/storage/' . $product->image) }}" 
                         alt="{{ $product->title }}" 
                         class="max-w-full max-h-full object-contain mx-auto">
                </div>
            @else
                <div class="w-full h-full flex items-center justify-center bg-gray-100">
                    <span class="text-gray-400">Nincs kép</span>
                </div>
            @endif
        </div>
        
        @if($product->images->count() > 1)
            <button id="prev-image-btn" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-r-lg hover:bg-opacity-70 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button id="next-image-btn" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-l-lg hover:bg-opacity-70 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
            
            <div class="absolute bottom-2 left-1/2 transform -translate-x-1/2 bg-black bg-opacity-50 text-white px-3 py-1 rounded-full text-sm">
                <span id="current-image-index">1</span>/<span id="total-images">{{ $product->images->count() }}</span>
            </div>
        @endif
        
        @if($product->images->count() > 1)
            <div class="mt-4 flex space-x-2 overflow-x-auto pb-2">
                @foreach($product->images as $index => $image)
                    <div class="thumbnail-image cursor-pointer {{ $index === 0 ? 'ring-2 ring-purple-500' : '' }}" data-index="{{ $index }}">
                        <img src="{{ asset('public/storage/' . $image->image) }}" 
                             alt="Miniatűr {{ $index + 1 }}" 
                             class="w-16 h-16 object-cover rounded">
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <h2 class="text-2xl font-bold text-gray-800 mt-6">{{ $product->title }}</h2>

    <p class="text-purple-600 font-bold mt-2">{{ number_format($product->price, 0, ',', ' ') }} Ft</p>

    <p class="text-gray-600 text-sm mt-4">{{ $product->description }}</p>

    <div class="mt-6">
        <h3 class="text-lg font-semibold text-gray-800">Kapcsolattartási adatok</h3>
        <p class="text-gray-600"><strong>E-mail:</strong> <a href="mailto:{{ $product->email }}" class="text-purple-600 hover:underline">{{ $product->email }}</a></p>
        @if($product->phone)
            <p class="text-gray-600"><strong>Telefonszám:</strong> {{ $product->phone }}</p>
        @else
            <p class="text-gray-600"><strong>Telefonszám:</strong> Nincs megadva</p>
        @endif
    </div>

    <div class="mt-6">
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

    <div class="mt-6">
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">
            Kategória: {{ $product->category->name }}
        </span>
    </div>

    @auth
        @if (Auth::id() !== $product->user_id)
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-800">Üzenet küldése az eladónak</h3>
                <form action="{{ route('messages.sendFromProduct', $product) }}" method="POST" class="mt-4">
                    @csrf
                    <textarea 
                        name="message" 
                        rows="4" 
                        class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-purple-500"
                        placeholder="Írj üzenetet az eladónak..."
                        required
                    ></textarea>
                    <button 
                        type="submit" 
                        class="bg-purple-600 text-white px-5 py-2 rounded-lg hover:bg-purple-700 transition duration-300 mt-2"
                    >
                        Üzenet küldése
                    </button>
                </form>
            </div>
        @else
            <p class="text-gray-600 mt-6">Ez a te hirdetésed, nem küldhetsz magadnak üzenetet.</p>
        @endif
    @endauth

    @guest
        <p class="text-gray-600 mt-6">Üzenet küldéséhez <a href="{{ route('login') }}" class="text-purple-600 hover:underline">jelentkezz be</a>.</p>
    @endguest
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const productImages = document.querySelectorAll('.product-image');
        const thumbnailImages = document.querySelectorAll('.thumbnail-image');
        const prevButton = document.getElementById('prev-image-btn');
        const nextButton = document.getElementById('next-image-btn');
        const currentImageIndex = document.getElementById('current-image-index');
        const totalImages = {{ $product->images->count() }};
        let currentIndex = 0;
        
        function showImage(index) {
            productImages.forEach(image => {
                image.classList.add('hidden');
            });
            
            productImages[index].classList.remove('hidden');
            
            if (currentImageIndex) {
                currentImageIndex.textContent = index + 1;
            }
            
            thumbnailImages.forEach((thumb, i) => {
                if (i === index) {
                    thumb.classList.add('ring-2', 'ring-purple-500');
                } else {
                    thumb.classList.remove('ring-2', 'ring-purple-500');
                }
            });
            
            currentIndex = index;
        }
        
        if (prevButton) {
            prevButton.addEventListener('click', function() {
                const newIndex = (currentIndex - 1 + totalImages) % totalImages;
                showImage(newIndex);
            });
        }
        
        if (nextButton) {
            nextButton.addEventListener('click', function() {
                const newIndex = (currentIndex + 1) % totalImages;
                showImage(newIndex);
            });
        }
        
        thumbnailImages.forEach((thumb, index) => {
            thumb.addEventListener('click', function() {
                showImage(index);
            });
        });
        
        document.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowLeft') {
                if (prevButton) prevButton.click();
            } else if (e.key === 'ArrowRight') {
                if (nextButton) nextButton.click();
            }
        });
    });
</script>
@endsection
