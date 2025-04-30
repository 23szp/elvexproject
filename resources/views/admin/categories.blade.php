@extends('layouts.app')

@section('title', 'Admin - Kategóriák')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Kategóriák</h1>
    <form method="POST" action="{{ route('admin.categories.create') }}" class="mb-6">
        @csrf
        <div class="flex gap-4">
            <input type="text" name="name" placeholder="Kategória neve" class="flex-1 p-2 border rounded">
            <input type="text" name="slug" placeholder="Kategória slug" class="flex-1 p-2 border rounded">
            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-500">
                Kategória hozzáadása
            </button>
        </div>
    </form>
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Név</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Slug</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Műveletek</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $category->name }}</td>
                        <td class="px-6 py-4">{{ $category->slug }}</td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.categories.delete', $category) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-500">
                                    Törlés
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection