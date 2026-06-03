<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Menampilkan semua order milik user yang login
    public function index(Request $request)
    {
        $orders = Order::with('items.product')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json($orders);
    }

    // Membuat order baru
    public function store(Request $request)
    {
        $request->validate([
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $totalPrice = 0;

            foreach ($request->items as $item) {

                $product = Product::findOrFail($item['product_id']);

                if ($product->stock < $item['quantity']) {
                    return response()->json([
                        'message' => "Stok {$product->name} tidak mencukupi"
                    ], 400);
                }

                $totalPrice += $product->price * $item['quantity'];
            }

            $order = Order::create([
                'user_id' => $request->user()->id,
                'total_price' => $totalPrice,
                'status' => 'pending',
                'notes' => $request->notes,
            ]);

            foreach ($request->items as $item) {

                $product = Product::findOrFail($item['product_id']);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->price,
                ]);

                // Kurangi stok
                $product->stock -= $item['quantity'];
                $product->save();
            }

            DB::commit();

            return response()->json([
                'message' => 'Order berhasil dibuat',
                'data' => $order->load('items.product')
            ], 201);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Detail order
    public function show(string $id)
    {
        $order = Order::with('items.product')
            ->findOrFail($id);

        return response()->json($order);
    }

    // Update status order
    public function updateStatus(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,done,cancelled'
        ]);

        $order = Order::findOrFail($id);

        $order->status = $request->status;
        $order->save();

        return response()->json([
            'message' => 'Status order berhasil diupdate',
            'data' => $order
        ]);
    }
}
