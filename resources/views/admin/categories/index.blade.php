@extends('layouts.app')

@section('title', 'Kategóriák kezelése')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Kategóriák kezelése</h1>

    <a href="{{ route('admin.categories.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded mb-4 inline-block">Új kategória</a>

    <ul>
        @foreach($categories as $category)
            <li>
                <strong>{{ $category->name }}</strong>
                @if($category->children->count() > 0)
                    <ul class="ml-4">
                        @foreach($category->children as $child)
                            <li>{{ $child->name }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="mt-2">
                    <a href="{{ route('admin.categories.edit', $category) }}" class="text-blue-600 hover:underline">Szerkesztés</a>
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Biztosan törölni szeretnéd?')">Törlés</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endsection
