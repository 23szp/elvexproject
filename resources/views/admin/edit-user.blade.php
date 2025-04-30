@extends('layouts.app')

@section('title', 'Felhasználó szerkesztése')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Felhasználó szerkesztése: {{ $user->name }}</h2>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Név</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror"
                   id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required>
            @error('name')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror"
                   id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Új jelszó</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror"
                   id="password" type="password" name="password">
            <p class="text-gray-600 text-xs mt-1">Hagyd üresen, ha nem szeretnéd megváltoztatni.</p>
            @error('password')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">Új jelszó megerősítése</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   id="password_confirmation" type="password" name="password_confirmation">
        </div>

        <div class="mb-6">
            <label class="flex items-center">
                <input type="checkbox" name="is_admin" class="form-checkbox h-5 w-5 text-purple-600" {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}>
                <span class="ml-2 text-gray-700 font-bold">Admin jogosultság</span>
            </label>
        </div>

        <div class="flex items-center justify-between">
            <button class="bg-purple-600 hover:bg-purple-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">Mentés</button>
            <a href="/admin/users" class="text-gray-600 hover:text-gray-800">Vissza a listához</a>
        </div>
    </form>
</div>
@endsection
