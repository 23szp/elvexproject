<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - ElveX</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
        </div>
    </nav>

    <main class="py-8">
        <div class="max-w-6xl mx-auto px-4">
            @yield('content')
        </div>
    </main>
</body>
</html>