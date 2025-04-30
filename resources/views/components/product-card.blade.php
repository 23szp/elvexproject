<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <a href="{{ route('products.show', $product) }}">
        <img src="{{ asset('public/storage/' . $product->image) }}" 
             alt="{{ $product->title }}" 
             class="w-full h-48 object-cover">
    </a>

    <div class="p-4">

        <h3 class="text-lg font-semibold text-gray-800 truncate">{{ $product->title }}</h3>

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

        <div class="mt-3">
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">
                Kategória: {{ $product->category ? $product->category->name : 'Nincs kategória' }}
            </span>
        </div>

        <div class="mt-4 flex justify-between items-center">
            <div class="flex items-center flex-1 min-w-0">
                <img class="h-8 w-8 rounded-full object-cover flex-shrink-0" 
                     src="{{ $product->user->profile_image ? asset('public/storage/' . $product->user->profile_image) : 'https://www.gravatar.com/avatar/' . md5($product->user->email) . '?d=mp' }}" 
                     alt="{{ $product->user->name }}">
                <span class="ml-2 text-sm text-gray-600 truncate">{{ $product->user->name }}</span>
            </div>

            <div class="flex items-center gap-2">
                @if(auth()->user() && auth()->user()->savedProducts->contains($product->id))
                    <form method="POST" action="{{ route('products.unsave', $product) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-gray-500 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                            <span class="text-sm">{{ $product->saved_count }}</span>
                        </button>
                    </form>
                @else
                    <form method="POST" action="{{ route('products.save', $product) }}">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-red-500 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 21.364l-7.682-7.682a4.5 4.5 0 010-6.364z" />
                            </svg>
                            <span class="text-sm">{{ $product->saved_count }}</span>
                        </button>
                    </form>
                @endif
            </div>

            <a href="{{ route('products.show', $product) }}" 
               class="text-purple-600 hover:text-purple-500 text-sm whitespace-nowrap">
                Részletek
            </a>
        </div>
    </div>
</div>
