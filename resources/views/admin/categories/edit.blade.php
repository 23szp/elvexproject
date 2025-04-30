@extends('layouts.app')

@section('title', 'Kategória szerkesztése')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Kategória szerkesztése</h1>

    <form method="POST" action="{{ route('admin.categories.update', $category) }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Kategória neve</label>
            <input type="text" name="name" id="name" class="w-full border rounded px-3 py-2" value="{{ $category->name }}" required>
        </div>

        <div class="mb-4">
            <label for="slug" class="block text-gray-700 font-bold mb-2">Slug</label>
            <input type="text" name="slug" id="slug" class="w-full border rounded px-3 py-2" value="{{ $category->slug }}" required>
        </div>

        <div class="mb-4">
            <label for="parent_id" class="block text-gray-700 font-bold mb-2">Szülőkategória</label>
            <select name="parent_id" id="parent_id" class="w-full border rounded px-3 py-2">
                <option value="">Nincs (főkategória)</option>
                @foreach($categories as $parent)
                    <option value="{{ $parent->id }}" {{ $category->parent_id == $parent->id ? 'selected' : '' }}>
                        {{ $parent->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded">Mentés</button>
    </form>
</div>
@endsection
