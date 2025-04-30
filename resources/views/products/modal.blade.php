<div>
    <h2 class="text-2xl font-bold text-gray-800">{{ $product->title }}</h2>
    <p class="text-purple-600 font-bold mt-2">{{ number_format($product->price, 0, ',', ' ') }} Ft</p>
    <p class="text-gray-600 text-sm mt-2">{{ $product->description }}</p>
    
    <div class="relative mt-4">
        <div id="modal-images-container" class="w-full h-64 relative">
            @if($product->images->count() > 0)
                @foreach($product->images as $index => $image)
                    <div class="modal-image w-full h-full {{ $index === 0 ? 'block' : 'hidden' }}" data-index="{{ $index }}">
                        <img src="{{ asset('public/storage/' . $image->image) }}" 
                             alt="{{ $product->title }}" 
                             class="max-w-full max-h-full object-contain mx-auto">
                    </div>
                @endforeach
            @else
                <div class="w-full h-full flex items-center justify-center bg-gray-100">
                    <span class="text-gray-400">Nincs kép</span>
                </div>
            @endif
        </div>
        
        @if($product->images->count() > 1)
            <button id="modal-prev-btn" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-r-lg hover:bg-opacity-70 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button id="modal-next-btn" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-l-lg hover:bg-opacity-70 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
            
            <div class="absolute bottom-2 left-1/2 transform -translate-x-1/2 bg-black bg-opacity-50 text-white px-3 py-1 rounded-full text-sm">
                <span id="modal-current-index">1</span>/<span id="modal-total-images">{{ $product->images->count() }}</span>
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalImages = document.querySelectorAll('.modal-image');
        const prevButton = document.getElementById('modal-prev-btn');
        const nextButton = document.getElementById('modal-next-btn');
        const currentImageIndex = document.getElementById('modal-current-index');
        const totalImages = {{ $product->images->count() }};
        let currentIndex = 0;
        
        function showModalImage(index) {
            modalImages.forEach(image => {
                image.classList.add('hidden');
            });
            
            modalImages[index].classList.remove('hidden');
            
            if (currentImageIndex) {
                currentImageIndex.textContent = index + 1;
            }
            
            currentIndex = index;
        }
        
        if (prevButton) {
            prevButton.addEventListener('click', function() {
                const newIndex = (currentIndex - 1 + totalImages) % totalImages;
                showModalImage(newIndex);
            });
        }
        
        if (nextButton) {
            nextButton.addEventListener('click', function() {
                const newIndex = (currentIndex + 1) % totalImages;
                showModalImage(newIndex);
            });
        }
    });
</script>
