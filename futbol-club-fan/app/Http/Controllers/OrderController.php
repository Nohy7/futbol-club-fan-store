<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|integer|exists:products,id',
            'items.*.size' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric',
        ]);


        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'error' => 'Usuario no autenticado'], 403);
        }

        try {
            \DB::beginTransaction();

            $order = Order::create([
                'user_id' => $user->id,
                'status' => 'pendiente',
                'total' => array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $request->items)),
            ]);

            foreach ($request->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'size_id' => $this->getSizeId($item['size']),
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            \DB::commit();

            return response()->json([
                'success' => true,
                'orderId' => $order->id
            ]);
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    private function getSizeId(string $sizeName): int
    {
        $size = \App\Models\Size::firstOrCreate(
            ['name' => strtoupper($sizeName)]
        );
        return $size->id;
    }
}
