<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories',
            'description' => 'nullable'
        ]);

        $category = Category::create($validated);

        return response()->json($category, 201);
    }

    public function show(string $id)
    {
        $category = Category::with('products')->findOrFail($id);

        return response()->json($category);
    }

    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,' . $id,
            'description' => 'nullable'
        ]);

        $category->update($validated);

        return response()->json($category);
    }

    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        if ($category->products()->count() > 0) {
            return response()->json([
                'message' => 'Kategori masih memiliki produk'
            ], 400);
        }

        $category->delete();

        return response()->json([
            'message' => 'Kategori berhasil dihapus'
        ]);
    }
}
