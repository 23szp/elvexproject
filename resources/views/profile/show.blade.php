@extends('layouts.app')

@section('title', 'Profil')

@section('content')
<div class="max-w-6xl mx-auto bg-white rounded-lg shadow-md p-6">
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

    <div class="mb-6">
        <ul class="flex border-b">
            <li class="-mb-px mr-1">
                <a class="bg-white inline-block py-2 px-4 text-purple-600 font-semibold cursor-pointer" onclick="showTab('profileEdit')">Profil szerkesztése</a>
            </li>
            <li class="mr-1">
                <a class="bg-white inline-block py-2 px-4 text-gray-600 hover:text-purple-600 cursor-pointer" onclick="showTab('loginLogs')">Bejelentkezési napló</a>
            </li>
        </ul>
    </div>

    <div id="profileEdit" class="tab-content">
        <div class="flex justify-center mb-6">
            <div class="relative w-32 h-32 rounded-full overflow-hidden border-4 border-purple-500 cursor-pointer" id="profileImageContainer">
@if(Auth::user()->profile_image)
    <img src="{{ asset('public/storage/' . Auth::user()->profile_image) }}" 
        alt="Profilkép" 
        class="w-full h-full object-cover" 
        id="profileImage">
@else
    <svg class="w-full h-full text-gray-300" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 14.016q2.531 0 5.273 1.102t2.742 2.883v2.016h-16.031v-2.016q0-1.781 2.742-2.883t5.273-1.102zM12 12q-1.641 0-2.813-1.172t-1.172-2.813 1.172-2.836 2.813-1.195 2.813 1.195 1.172 2.836-1.172 2.813-2.813 1.172z"></path>
    </svg>
@endif
                <form method="POST" action="{{ route('profile.updateImage') }}" enctype="multipart/form-data" id="profileImageForm">
                    @csrf
                    @method('PUT')
                    <input type="file" name="profile_image" id="profileImageInput" class="hidden" accept="image/*">
                </form>
            </div>
        </div>

        @if(Auth::user()->profile_image)
            <div class="flex justify-center mb-6">
                <form action="{{ route('profile.deleteImage') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Profilkép törlése
                    </button>
                </form>
            </div>
        @endif

        <h2 class="text-2xl font-semibold mb-6 text-center">Profil adatok módosítása</h2>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Név</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror"
                       id="name" type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                @error('name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror"
                       id="email" type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                @error('email')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4 relative">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="current_password">Jelenlegi jelszó a megerősítéshez:</label>
                <div class="relative">
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('current_password') border-red-500 @enderror"
                           id="current_password" type="password" name="current_password" required>
                </div>
                @error('current_password')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4 relative">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Új jelszó (opcionális)</label>
                <div class="relative">
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror"
                           id="password" type="password" name="password">
                </div>
                @error('password')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4 relative">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">Új jelszó megerősítése</label>
                <div class="relative">
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           id="password_confirmation" type="password" name="password_confirmation">
                </div>
            </div>

            <button class="w-full bg-purple-600 hover:bg-purple-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">Adatok mentése</button>
        </form>
    </div>

    <div id="loginLogs" class="tab-content hidden">
        <h2 class="text-xl font-semibold mb-4">Bejelentkezési események</h2>
        @if($loginLogs->isEmpty())
            <p class="text-gray-600">Nincs bejelentkezési esemény.</p>
        @else
            <ul class="space-y-4">
                @foreach($loginLogs as $log)
                    <li class="border-b pb-2">
                        <span class="block text-sm text-gray-700"><strong>Időpont:</strong> {{ $log->created_at->format('Y-m-d H:i:s') }}</span>
                        <span class="block text-sm text-gray-700"><strong>IP-cím:</strong> {{ $log->ip_address ?? 'Ismeretlen' }}</span>
                        <span class="block text-sm text-gray-700"><strong>Eszköz:</strong> {{ $log->user_agent ?? 'Ismeretlen' }}</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>

<script>
    function showTab(tabId) {
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.add('hidden');
        });

        document.getElementById(tabId).classList.remove('hidden');
    }

    document.addEventListener('DOMContentLoaded', function () {
        showTab('profileEdit'); 
    });
    document.addEventListener('DOMContentLoaded', function () {
        const profileImageContainer = document.getElementById('profileImageContainer');
        const profileImageInput = document.getElementById('profileImageInput');
        const profileImageForm = document.getElementById('profileImageForm');

        profileImageContainer.addEventListener('click', function () {
            profileImageInput.click();
        });

  
        profileImageInput.addEventListener('change', function () {
            if (profileImageInput.files.length > 0) {
                profileImageForm.submit();
            }
        });
    });
</script>
@endsection
