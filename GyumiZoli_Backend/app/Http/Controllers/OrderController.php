<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        // Ensure the request data is properly encoded in UTF-8
        $items = json_encode($request->input('items'), JSON_UNESCAPED_UNICODE);

        // Létrehozzuk a megrendelést
        $order = Order::create([
            'user_id' => $request->input('user_id'),
            'items' => $items, 
            'totalPrice' => $request->input('totalPrice'),
        ]);

        return response()->json(['message' => 'Megrendelés sikeresen létrehozva!', 'order' => $order], 201);
    }

    public function getOrder()
    {
        $order = Order::all();
        return response()->json($order);
    }

    public function deleteOrder(Request $request)
    {
        $order = Order::find($request->id);
        if (!$order) {
            return response()->json("Nem található a megrendelés!");
        }
        $order->delete();
        return response()->json("Megrendelés törölve!");
    }
    
}

