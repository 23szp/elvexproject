@extends('layouts.app')

@section('title', 'Üzenetek')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold mb-4">Üzenetek</h1>
    
    @if(empty($conversations))
        <div class="text-center py-8">
            <p class="text-gray-500">Még nincsenek üzeneteid.</p>
        </div>
    @else
        <ul class="divide-y divide-gray-200">
            @foreach ($conversations as $productId => $productConversations)
                @foreach ($productConversations as $conversationKey => $conversationData)
                    @php
                        $lastMessage = $conversationData['message'];
                        $partner = $conversationData['partner'];
                        $unreadCount = $conversationData['unread_count'];
                        $product = $lastMessage->product;
                    @endphp
                    <li class="py-4 flex items-center hover:bg-gray-100 transition duration-300 rounded-lg px-4 cursor-pointer relative" 
                        onclick="window.location='{{ route('messages.show', ['user' => $partner->id, 'productId' => $productId]) }}'">
                        @if($product)
                            <div class="flex-shrink-0 relative">
                                <img src="{{ url('public/storage/' . ltrim($product->image, '/')) }}" 
                                    alt="{{ $product->title }}" 
                                    class="h-12 w-12 rounded-lg object-cover mr-4 border border-gray-200">
                                
                                @if($unreadCount > 0)
                                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                                        {{ $unreadCount }}
                                    </span>
                                @endif
                            </div>
                        @endif
                        
                        <div class="ml-4 flex-1 min-w-0">
                            <div class="flex items-center">
                                <span class="text-lg font-semibold text-gray-800 hover:underline truncate">
                                    {{ $partner->name }}
                                </span>
                                @if($unreadCount > 0)
                                    <span class="ml-2 bg-purple-100 text-purple-800 text-xs px-2 py-0.5 rounded-full">
                                        {{ $unreadCount }} új
                                    </span>
                                @endif
                            </div>
                            @if($product)
                                <p class="text-sm text-gray-600 truncate">Hirdetés: {{ $product->title }}</p>
                            @endif
                            <p class="text-gray-600 text-sm truncate {{ $unreadCount > 0 ? 'font-semibold' : '' }}">
                                {{ Str::limit($lastMessage->message, 50) }}
                            </p>
                        </div>
                        
                        <span class="ml-auto text-gray-400 text-xs whitespace-nowrap">{{ $lastMessage->created_at->diffForHumans() }}</span>
                    </li>
                @endforeach
            @endforeach
        </ul>
    @endif
</div>

<style>
@supports (-webkit-touch-callout: none) {
    .flex-1 {
        flex: 1 1 0%;
    }
}
</style>
@endsection
