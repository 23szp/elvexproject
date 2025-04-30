@extends('layouts.app')

@section('title', 'Beszélgetés')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md overflow-hidden flex flex-col" style="height: calc(100vh - 120px); max-height: 90vh;">
    <div class="bg-gradient-to-r from-purple-600 to-purple-800 text-white p-3 sticky top-0 z-10">
        <div class="flex items-center">
            <a href="{{ route('messages.index') }}" class="mr-2 text-white hover:text-purple-200 transition flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            
            @if($product)
                <div class="flex items-center w-full overflow-hidden">
                    <div class="bg-white p-1 rounded-lg mr-2 flex-shrink-0">
                        <img src="{{ url('public/storage/' . ltrim($product->image, '/')) }}" 
                             alt="{{ $product->title }}" 
                             class="h-10 w-10 sm:h-12 sm:w-12 rounded-lg object-cover">
                    </div>
                    <div class="min-w-0 flex-1">
                        <h3 class="text-sm sm:text-md font-bold text-white truncate">{{ $product->title }}</h3>
                        <div class="flex items-center bg-white bg-opacity-20 rounded-full px-2 py-1 mt-1 w-fit">
                            @php
                                $profileImagePath = $user->profile_image 
                                    ? (Str::contains($user->profile_image, 'profile_images/') 
                                        ? url('public/storage/' . $user->profile_image)
                                        : url('public/storage/profile_images/' . $user->profile_image))
                                    : 'https://www.gravatar.com/avatar/' . md5($user->email) . '?d=mp';
                            @endphp
                            <img class="h-4 w-4 sm:h-5 sm:w-5 rounded-full object-cover mr-1 flex-shrink-0" 
                                 src="{{ $profileImagePath }}" 
                                 alt="{{ $user->name }}">
                            <p class="text-xs text-white truncate">{{ $user->name }}</p>
                        </div>
                    </div>
                    <div class="ml-2 bg-white text-purple-700 font-bold px-2 py-1 rounded-lg text-xs sm:text-sm flex-shrink-0 whitespace-nowrap">
                        {{ number_format($product->price, 0, ',', ' ') }} Ft
                    </div>
                    
                    @if(isset($isProductOwner) && $isProductOwner && isset($chatPartners) && count($chatPartners) > 1)
                        <div class="ml-2 relative" style="position: static;">
                            <button id="chatPartnersButton" class="bg-white text-purple-700 px-2 py-1 rounded-lg text-xs sm:text-sm flex items-center">
                                <span>Beszélgetőpartnerek</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            
                            <div id="chatPartnersDropdown" class="hidden fixed w-48 bg-white rounded-md shadow-lg z-50">
                                <ul class="py-1">
                                    @foreach($chatPartners as $partner)
                                        <li>
                                            <a href="{{ route('messages.show', ['user' => $partner->id, 'productId' => $product->id]) }}" 
                                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-100 {{ $partner->id === $user->id ? 'bg-purple-100 font-semibold' : '' }}">
                                                {{ $partner->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <div class="flex items-center">
                    @php
                        $profileImagePath = $user->profile_image 
                            ? (Str::contains($user->profile_image, 'profile_images/') 
                                ? url('public/storage/' . $user->profile_image)
                                : url('public/storage/profile_images/' . $user->profile_image))
                            : 'https://www.gravatar.com/avatar/' . md5($user->email) . '?d=mp';
                    @endphp
                    <div class="bg-white p-1 rounded-full mr-3 flex-shrink-0">
                        <img class="h-8 w-8 sm:h-10 sm:w-10 rounded-full object-cover" 
                             src="{{ $profileImagePath }}" 
                             alt="{{ $user->name }}">
                    </div>
                    <h1 class="text-md sm:text-lg font-bold truncate">{{ $user->name }}</h1>
                </div>
            @endif
        </div>
    </div>

    <div id="messages" class="flex-1 overflow-y-auto p-3 sm:p-4 bg-gray-50">
        @foreach ($messages as $message)
            @php
                $isMyMessage = $message->sender_id === auth()->id();
                $showDate = $loop->first || $message->created_at->diffInMinutes($messages[$loop->index-1]->created_at) > 30;
                $showAvatar = !$isMyMessage && ($loop->first || $messages[$loop->index-1]->sender_id !== $message->sender_id);
                $consecutive = !$loop->first && $messages[$loop->index-1]->sender_id === $message->sender_id;
            @endphp
            
            @if($showDate)
                <div class="flex justify-center my-3">
                    <span class="text-xs bg-gray-200 text-gray-600 rounded-lg px-4 py-1 shadow-sm">
                        @if($message->created_at->isToday())
                            Ma, {{ $message->created_at->format('H:i') }}
                        @elseif($message->created_at->isYesterday())
                            Tegnap, {{ $message->created_at->format('H:i') }}
                        @else
                            {{ $message->created_at->format('Y. m. d. H:i') }}
                        @endif
                    </span>
                </div>
            @endif
            
            <div class="flex {{ $isMyMessage ? 'justify-end' : 'justify-start' }} mb-2 group" data-sender-id="{{ $message->sender_id }}">
                <div class="flex max-w-[85%] sm:max-w-[75%] {{ $isMyMessage ? 'flex-row-reverse' : '' }}">
                    @if(!$isMyMessage && $showAvatar)
                        <div class="flex-shrink-0 {{ $isMyMessage ? 'ml-2' : 'mr-2' }} self-end">
                            @php
                                $profileImagePath = $message->sender->profile_image 
                                    ? (Str::contains($message->sender->profile_image, 'profile_images/') 
                                        ? url('public/storage/' . $message->sender->profile_image)
                                        : url('public/storage/profile_images/' . $message->sender->profile_image))
                                    : 'https://www.gravatar.com/avatar/' . md5($message->sender->email) . '?d=mp';
                            @endphp
                            <img class="h-8 w-8 rounded-full object-cover border-2 border-white shadow-sm" 
                                 src="{{ $profileImagePath }}" 
                                 alt="{{ $message->sender->name }}">
                        </div>
                    @elseif(!$isMyMessage && !$showAvatar)
                        <div class="w-8 {{ $isMyMessage ? 'ml-2' : 'mr-2' }} flex-shrink-0"></div>
                    @endif
                    
                    <div class="{{ $isMyMessage 
                        ? ($consecutive ? 'bg-purple-500' : 'bg-gradient-to-br from-purple-500 to-purple-700') . ' text-white rounded-tl-xl rounded-tr-xl rounded-bl-xl' 
                        : ($consecutive ? 'bg-white' : 'bg-gradient-to-br from-gray-100 to-white') . ' text-gray-800 rounded-tl-xl rounded-tr-xl rounded-br-xl'
                    }} py-2 px-3 sm:px-4 shadow-sm break-words relative max-w-full overflow-hidden">
                        <p class="text-sm whitespace-pre-wrap overflow-wrap-anywhere">{{ $message->message }}</p>
                        <div class="h-5"></div> 
                        <span class="text-xs {{ $isMyMessage ? 'text-purple-200' : 'text-gray-400' }} absolute bottom-1 {{ $isMyMessage ? 'left-2' : 'right-2' }} opacity-0 group-hover:opacity-100 transition-opacity">
                            {{ $message->created_at->format('H:i') }}
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="border-t border-gray-200 p-2 sm:p-3 bg-white">
        <form id="messageForm" action="{{ route('messages.sendToUser', $user) }}" method="POST" class="flex items-center">
            @csrf
            <div class="flex-1 relative">
                <textarea name="message" 
                          class="w-full border border-gray-300 rounded-lg py-2 pl-3 pr-8 focus:outline-none focus:ring-2 focus:ring-purple-500 resize-none overflow-hidden shadow-sm"
                          placeholder="Írj üzenetet... (max 256 karakter)"
                          rows="1"
                          required
                          maxlength="256"
                          id="messageInput"></textarea>
                <div id="charCounter" class="text-xs text-gray-500 absolute bottom-1 right-2">0/256</div>
            </div>
            
            @if($product)
                <input type="hidden" name="product_id" value="{{ $product->id }}">
            @endif
            
            <button type="submit" class="ml-2 bg-gradient-to-r from-purple-600 to-purple-800 text-white p-2 rounded-lg hover:from-purple-700 hover:to-purple-900 transition duration-300 flex items-center justify-center shadow-md flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                </svg>
            </button>
        </form>
    </div>
</div>

<style>
#messages::-webkit-scrollbar {
    width: 6px;
}

#messages::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

#messages::-webkit-scrollbar-thumb {
    background: #d1d5db;
    border-radius: 10px;
}

#messages::-webkit-scrollbar-thumb:hover {
    background: #a855f7;
}

#messageInput {
    max-height: 100px;
    min-height: 38px;
}

.overflow-wrap-anywhere {
    overflow-wrap: anywhere;
    word-break: break-word;
}

#messages .flex .max-w-[85%] {
    width: 85%;
}

@media (min-width: 640px) {
    #messages .flex .max-w-[75%] {
        width: 75%;
    }
}

@supports (-webkit-touch-callout: none) {
    .flex-1 {
        flex: 1 1 0%;
    }
}

#chatPartnersDropdown {
    z-index: 9999;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}
</style>

<script>
    const messagesDiv = document.getElementById('messages');
    const messageInput = document.getElementById('messageInput');
    const charCounter = document.getElementById('charCounter');
    
    const chatPartnersButton = document.getElementById('chatPartnersButton');
    const chatPartnersDropdown = document.getElementById('chatPartnersDropdown');
    
    if (chatPartnersButton && chatPartnersDropdown) {
        chatPartnersButton.addEventListener('click', function(e) {
            e.stopPropagation();
            chatPartnersDropdown.classList.toggle('hidden');
            
            if (!chatPartnersDropdown.classList.contains('hidden')) {
                const buttonRect = chatPartnersButton.getBoundingClientRect();
                chatPartnersDropdown.style.top = (buttonRect.bottom + window.scrollY) + 'px';
                chatPartnersDropdown.style.left = (buttonRect.left + window.scrollX) + 'px';
                
                setTimeout(() => {
                    const dropdownRect = chatPartnersDropdown.getBoundingClientRect();
                    if (dropdownRect.right > window.innerWidth) {
                        chatPartnersDropdown.style.left = (window.innerWidth - dropdownRect.width - 10 + window.scrollX) + 'px';
                    }
                    if (dropdownRect.bottom > window.innerHeight) {
                        chatPartnersDropdown.style.top = (buttonRect.top - dropdownRect.height + window.scrollY) + 'px';
                    }
                }, 0);
            }
        });
        
        document.addEventListener('click', function() {
            if (!chatPartnersDropdown.classList.contains('hidden')) {
                chatPartnersDropdown.classList.add('hidden');
            }
        });
        
        chatPartnersDropdown.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }

    messageInput.addEventListener('input', function() {
        
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
        
        if (this.scrollHeight > 100) {
            this.style.height = '100px';
            this.style.overflowY = 'auto';
        } else {
            this.style.overflowY = 'hidden';
        }
        
        const charCount = this.value.length;
        const maxChars = 256;
        
        charCounter.textContent = `${charCount}/${maxChars}`;
        
        if (charCount > maxChars * 0.8) {
            charCounter.classList.add('text-orange-500');
        } else {
            charCounter.classList.remove('text-orange-500');
        }
        
        if (charCount > maxChars) {
            charCounter.classList.add('text-red-500');
            charCounter.classList.remove('text-orange-500');
        } else {
            charCounter.classList.remove('text-red-500');
        }
    });

    messageInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            document.getElementById('messageForm').dispatchEvent(new Event('submit'));
        }
    });

    function scrollToBottom() {
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
    }

    window.onload = function() {
        scrollToBottom();
        messageInput.focus();
        
        function adjustHeight() {
            const vh = window.innerHeight * 0.01;
            document.documentElement.style.setProperty('--vh', `${vh}px`);
            const container = document.querySelector('.max-w-4xl');
            container.style.height = `calc(var(--vh, 1vh) * 90)`;
        }
        
        adjustHeight();
        window.addEventListener('resize', adjustHeight);
        
        charCounter.textContent = `0/256`;
    };

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    document.getElementById('messageForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = e.target;
        const formData = new FormData(form);
        const currentProductId = '{{ $product->id ?? "" }}';
        
        const messageText = messageInput.value.trim();
        if (messageText === '') return;
        if (messageText.length > 256) {
            alert('Az üzenet nem lehet hosszabb 256 karakternél.');
            return;
        }

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Hálózati hiba történt');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
               
                if (!currentProductId || data.message.product_id == currentProductId) {
                    const newMessage = document.createElement('div');
                    newMessage.classList.add('flex', 'justify-end', 'mb-2', 'group');
                    newMessage.dataset.senderId = '{{ auth()->id() }}';
                    
                    const now = new Date();
                    const timeStr = now.getHours().toString().padStart(2, '0') + ':' + 
                                   now.getMinutes().toString().padStart(2, '0');
                    
                    
                    const messageElements = document.querySelectorAll('[data-sender-id]');
                    const lastElement = messageElements[messageElements.length - 1];
                    const consecutive = lastElement && lastElement.dataset.senderId === '{{ auth()->id() }}';
                    
                    newMessage.innerHTML = `
                        <div class="flex max-w-[85%] sm:max-w-[75%] flex-row-reverse">
                            <div class="${consecutive ? 'bg-purple-500' : 'bg-gradient-to-br from-purple-500 to-purple-700'} text-white rounded-tl-xl rounded-tr-xl rounded-bl-xl py-2 px-3 sm:px-4 shadow-sm break-words relative max-w-full overflow-hidden">
                                <p class="text-sm whitespace-pre-wrap overflow-wrap-anywhere">${escapeHtml(data.message.message)}</p>
                                <div class="h-5"></div>
                                <span class="text-xs text-purple-200 absolute bottom-1 left-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    ${timeStr}
                                </span>
                            </div>
                        </div>
                    `;
                    
                    messagesDiv.appendChild(newMessage);
                    form.reset();
                    messageInput.style.height = 'auto';
                    charCounter.textContent = '0/256';
                    charCounter.classList.remove('text-orange-500', 'text-red-500');
                    scrollToBottom();
                }
            }
        })
        .catch(error => {
            console.error('Hiba történt:', error);
            alert('Hiba történt az üzenet küldése közben. Kérjük, próbálja újra.');
        });
    });

    function refreshMessages() {
        const currentProductId = '{{ $product->id ?? "" }}'; 
        const scrolledToBottom = messagesDiv.scrollHeight - messagesDiv.scrollTop <= messagesDiv.clientHeight + 100;
        
        fetch(`{{ route('messages.show', ['user' => $user->id, 'productId' => isset($product) ? $product->id : null]) }}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newMessages = doc.getElementById('messages');

            if (newMessages && newMessages.innerHTML !== messagesDiv.innerHTML) {
                messagesDiv.innerHTML = newMessages.innerHTML;
                
     
                document.querySelectorAll('.flex.justify-end').forEach(el => {
                    el.dataset.senderId = '{{ auth()->id() }}';
                });
                
                document.querySelectorAll('.flex.justify-start').forEach(el => {
                    el.dataset.senderId = '{{ $user->id }}';
                });
                
       
                if (scrolledToBottom) {
                    scrollToBottom();
                }
            }
        })
        .catch(error => console.error('Frissítési hiba:', error));
    }


    setInterval(refreshMessages, 1000);
    

    document.querySelectorAll('.flex.justify-end').forEach(el => {
        el.dataset.senderId = '{{ auth()->id() }}';
    });
    
    document.querySelectorAll('.flex.justify-start').forEach(el => {
        el.dataset.senderId = '{{ $user->id }}';
    });
</script>
@endsection
