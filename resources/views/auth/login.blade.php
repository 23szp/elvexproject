@extends('layouts.app')

@section('title', 'Bejelentkezés')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-semibold mb-6">Bejelentkezés</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror"
                   id="email" type="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Jelszó</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror"
                   id="password" type="password" name="password" required>
            @error('password')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex items-center justify-between mb-6">
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
    </div>
</div>
@endsection