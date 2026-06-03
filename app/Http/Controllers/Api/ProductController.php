<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan semua produk
    public function index()
    {
        $products = Product::with('category')
            ->where('is_active', true)
            ->paginate(10);

        return response()->json($products);
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|unique:products',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $product = Product::create($validated);

        return response()->json([
            'message' => 'Produk berhasil ditambahkan',
            'data' => $product
        ], 201);
    }

    // Menampilkan detail produk
    public function show(string $id)
    {
        $product = Product::with('category')->findOrFail($id);

        return response()->json($product);
    }

    // Update produk
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|unique:products,slug,' . $id,
            'description' => 'nullable',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $product->update($validated);

        return response()->json([
            'message' => 'Produk berhasil diupdate',
            'data' => $product
        ]);
    }

    // Hapus produk
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return response()->json([
            'message' => 'Produk berhasil dihapus'
        ]);
    }

    // Toggle aktif/nonaktif produk
    public function toggle(string $id)
    {
        $product = Product::findOrFail($id);

        $product->is_active = !$product->is_active;
        $product->save();

        return response()->json([
            'message' => 'Status produk berhasil diubah',
            'is_active' => $product->is_active
        ]);
    }
}
