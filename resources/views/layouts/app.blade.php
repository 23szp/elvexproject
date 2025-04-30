<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - ElveX</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<<<<<<< HEAD
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        main {
            flex: 1;
        }

        footer {
            background-color: #f9fafb;
            border-top: 1px solid #e5e7eb;
            padding: 3rem 0;
        }
        
        .nav-shadow {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .dropdown-transition {
            transition: all 0.2s ease-in-out;
        }
        
     .notification-badge {
        position: absolute;
        top: -10px;
        right: -15px;
        background-color: #ef4444;
        color: white;
        border-radius: 9999px;
        font-size: 0.75rem;
        padding: 0.1rem 0.4rem;
        min-width: 1.5rem;
        text-align: center;
        font-weight: 600;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .relative-button {
        position: relative;
    }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <nav class="bg-white nav-shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ asset('images/elvex-logo.png') }}" alt="ElveX" class="h-12">
                </a>

                <div class="hidden md:block flex-grow mx-8">
                    <form action="{{ route('home') }}" method="GET" class="flex">
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Mit keresel?" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            value="{{ request('search') }}"
                        >
                        <button 
                            type="submit" 
                            class="bg-purple-600 text-white px-5 py-2 rounded-r-lg hover:bg-purple-700 transition duration-300"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </form>
                </div>

                <div class="flex items-center space-x-6">
                    <button class="md:hidden text-gray-700 hover:text-purple-600 transition duration-200" id="mobileSearchButton">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                    
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-purple-600 transition duration-200 font-medium">Bejelentkezés</a>
                        <a href="{{ route('register') }}" class="bg-purple-600 text-white px-5 py-2 rounded-lg hover:bg-purple-700 transition duration-300 font-medium">Regisztráció</a>
                    @else
                        @auth
                            <a href="{{ route('products.create') }}" class="bg-purple-600 text-white px-5 py-2 rounded-lg hover:bg-purple-700 transition duration-300 font-medium">
                                Hirdetés feltöltése
                            </a>

                            @if(Auth::user()->is_admin)
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" class="flex items-center focus:outline-none">
                                        <span class="text-gray-700 hover:text-purple-600 transition duration-200 font-medium">Admin Felület</span>
                                        <svg class="w-4 h-4 ml-2 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                    <div x-show="open" @click.away="open = false" class="z-20 absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 dropdown-transition">
                                        <a href="{{ route('admin.users') }}" class="block px-4 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition duration-200">Felhasználók</a>
                                        <a href="{{ route('admin.categories.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition duration-200">Kategóriák</a>
                                    </div>
                                </div>
                            @endif

                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="flex items-center focus:outline-none relative">
                                    <span class="text-gray-700 hover:text-purple-600 transition duration-200 font-medium">{{ Auth::user()->name }}</span>
                                    <svg class="w-4 h-4 ml-2 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                    
                                    @php
                                        // Lekérjük az olvasatlan üzenetek számát
                                        $unreadMessagesCount = \App\Models\Message::where('receiver_id', Auth::id())
                                            ->where('is_read', false)
                                            ->count();
                                    @endphp
                                    
                                    @if($unreadMessagesCount > 0)
                                        <span class="notification-badge">{{ $unreadMessagesCount }}</span>
                                    @endif
                                </button>
                                
                                <div x-show="open" @click.away="open = false" class="absolute z-20 right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 dropdown-transition">
                                    <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition duration-200">Profil kezelése</a>
                                    <a href="{{ route('profile.my-products') }}" class="block px-4 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition duration-200">Saját hirdetések</a>
                                    <a href="{{ route('saved-products.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition duration-200">Mentett hirdetések</a>
                                    <a href="{{ route('messages.index') }}" class="flex items-center justify-between px-4 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition duration-200">
                                        <span>Üzenetek</span>
                                        @if($unreadMessagesCount > 0)
                                            <span class="bg-red-500 text-white text-xs rounded-full px-2 py-0.5 ml-2">{{ $unreadMessagesCount }}</span>
                                        @endif
                                    </a>
                                    <div class="border-t my-1"></div>
                                    <form action="{{ route('logout') }}" method="POST" class="block px-4 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition duration-200">
                                        @csrf
                                        <button type="submit" class="w-full text-left">Kijelentkezés</button>
                                    </form>
                                </div>
                            </div>
                        @endauth
                    @endguest
                </div>
            </div>
            
            <div id="mobileSearchForm" class="md:hidden py-3 hidden">
                <form action="{{ route('home') }}" method="GET" class="flex">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Mit keresel?" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                        value="{{ request('search') }}"
                    >
                    <button 
                        type="submit" 
                        class="bg-purple-600 text-white px-4 py-2 rounded-r-lg hover:bg-purple-700 transition duration-300"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>
=======
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <a href="{{ route('home') }}" class="flex items-center py-4">
                        <span class="font-semibold text-gray-500 text-lg">ElveX</span>
                    </a>
                </div>
                <div class="flex items-center space-x-3">
                    @guest
                        <a href="{{ route('login') }}" class="py-2 px-4 text-gray-500 hover:text-gray-700">Bejelentkezés</a>
                        <a href="{{ route('register') }}" class="py-2 px-4 bg-purple-600 text-white rounded hover:bg-purple-500">Regisztráció</a>
                    @else
                        <a href="{{ route('products.create') }}" class="py-2 px-4 bg-purple-600 text-white rounded hover:bg-purple-500">Termék feltöltése</a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="py-2 px-4 text-gray-500 hover:text-gray-700">Kijelentkezés</button>
                        </form>
                    @endguest
                </div>
            </div>
>>>>>>> 4ecec8f1306eb8bbd1979d39463d687569b2f169
        </div>
    </nav>

    <main class="py-8">
<<<<<<< HEAD
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>

<footer>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">ElveX</h3>
                <ul class="text-gray-600 space-y-3">
                    <li><a href="{{ route('rolunk') }}" class="hover:text-purple-600 transition duration-200">Rólunk</a></li>
                    <li><a href="{{ route('kapcsolat') }}" class="hover:text-purple-600 transition duration-200">Kapcsolat</a></li>
                    <li><a href="{{ route('hirdetes') }}" class="hover:text-purple-600 transition duration-200">Hirdetési lehetőségek</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Segítség</h3>
                <ul class="text-gray-600 space-y-3">
                    <li><a href="{{ route('aszf') }}" class="hover:text-purple-600 transition duration-200">ÁSZF</a></li>
                    <li><a href="{{ route('adatvedelmi') }}" class="hover:text-purple-600 transition duration-200">Adatvédelmi szabályzat</a></li>
                    <li><a href="{{ route('sugo') }}" class="hover:text-purple-600 transition duration-200">Súgó</a></li>
                </ul>
            </div>

            <div class="flex justify-center items-center">
                <img 
                    src="{{ asset('images/since2025.png') }}" 
                    alt="Since 2025" 
                    class="h-48 object-contain"
                >
            </div>
        </div>
        <div class="mt-6 text-center">
            <p class="text-gray-600 text-sm">© 2025 ElveX. Minden jog fenntartva.</p>
        </div>
    </div>
</footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mobileSearchButton = document.querySelector('#mobileSearchButton');
            const mobileSearchForm = document.querySelector('#mobileSearchForm');

            mobileSearchButton?.addEventListener('click', function() {
                mobileSearchForm.classList.toggle('hidden');
            });
            
            function checkUnreadMessages() {
                fetch('/api/unread-messages-count')
                    .then(response => response.json())
                    .then(data => {
                        const unreadCount = data.count;
                        const notificationBadge = document.querySelector('.notification-badge');
                        const messageMenuBadge = document.querySelector('.bg-red-500.text-white.text-xs.rounded-full');
                        
                        if (unreadCount > 0) {
                            if (notificationBadge) {
                                notificationBadge.textContent = unreadCount;
                                notificationBadge.classList.remove('hidden');
                            } else {
                                const userButton = document.querySelector('button[x-data]');
                                if (userButton) {
                                    const badge = document.createElement('span');
                                    badge.className = 'notification-badge';
                                    badge.textContent = unreadCount;
                                    userButton.appendChild(badge);
                                }
                            }
                            
                            if (messageMenuBadge) {
                                messageMenuBadge.textContent = unreadCount;
                                messageMenuBadge.classList.remove('hidden');
                            }
                        } else {
                            if (notificationBadge) {
                                notificationBadge.classList.add('hidden');
                            }
                            if (messageMenuBadge) {
                                messageMenuBadge.classList.add('hidden');
                            }
                        }
                    })
                    .catch(error => console.error('Hiba az olvasatlan üzenetek lekérésekor:', error));
            }
            
            @auth

            @endauth
        });
    </script>
</body>
</html>
=======
        <div class="max-w-6xl mx-auto px-4">
            @yield('content')
        </div>
    </main>
</body>
</html>
>>>>>>> 4ecec8f1306eb8bbd1979d39463d687569b2f169
