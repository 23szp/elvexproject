@extends('layouts.app')

@section('title', 'Bejelentkezés')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-semibold mb-6">Bejelentkezés</h2>
    
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif
    
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror"
                   id="email" type="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <p class="text-red-500 text-xs italic">
                    {!! $message !!}
                    @if (str_contains($message, 'még nincs megerősítve'))
                        <br>
                        <a href="{{ route('email.resend.direct', ['email' => old('email')]) }}" class="text-purple-600 hover:underline">
                            Kattints ide az új megerősítő email elküldéséhez
                        </a>.
                    @endif
                </p>
            @enderror
        </div>
        <div class="mb-4 relative">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Jelszó</label>
            <div class="relative">
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror"
                       id="password" type="password" name="password" required>
                <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" onclick="togglePasswordVisibility()">
                    <svg id="eye-icon" class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </span>
            </div>
            @error('password')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center">
                <input class="mr-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="text-sm text-gray-700" for="remember">
                    Emlékezz rám
                </label>
            </div>
            @if (Route::has('password.request'))
                <a class="text-sm text-purple-600 hover:text-purple-500" href="{{ route('password.request') }}">
                    Elfelejtett jelszó?
                </a>
            @endif
        </div>
        
        <button class="w-full bg-purple-600 hover:bg-purple-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="submit">Bejelentkezés</button>
    </form>
    
    <div class="mt-6 text-center">
        <p class="text-sm text-gray-600">
            Még nincs fiókod? 
            <a href="{{ route('register') }}" class="text-purple-600 hover:text-purple-500 font-semibold">
                Regisztrálj itt
            </a>
        </p>
        @if (Route::has('resend.verification.form'))
            <p class="text-sm text-gray-600 mt-2">
                <a href="{{ route('resend.verification.form') }}" class="text-purple-600 hover:text-purple-500">
                    Megerősítő email újraküldése
                </a>
            </p>
        @endif
    </div>
</div>

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
            `;
        } else {
            passwordInput.type = 'password';
            eyeIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
            `;
        }
    }
</script>
@endsection
