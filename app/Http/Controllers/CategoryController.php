<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::whereNull('parent_id')->with('children')->get();
        return view('admin.categories.index', compact('categories'));
    }


    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.categories.create', compact('categories'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        Category::create($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Kategória sikeresen létrehozva!');
    }


    public function edit(Category $category)
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.categories.edit', compact('category', 'categories'));
    }


    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $category->id,
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category->update($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Kategória sikeresen frissítve!');
    }


    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Kategória sikeresen törölve!');
    }
    public function getChildren(Category $parent)
{
    return response()->json($parent->children);
}
}
