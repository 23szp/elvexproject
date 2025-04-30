@extends('layouts.app')

@section('title', 'Új kategória létrehozása')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Új kategória létrehozása</h1>

    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Kategória neve</label>
            <input type="text" name="name" id="name" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label for="slug" class="block text-gray-700 font-bold mb-2">Slug</label>
            <input type="text" name="slug" id="slug" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label for="parent_id" class="block text-gray-700 font-bold mb-2">Szülőkategória</label>
            <select name="parent_id" id="parent_id" class="w-full border rounded px-3 py-2">
                <option value="">Nincs (főkategória)</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded">Mentés</button>
    </form>
</div>
@endsection
