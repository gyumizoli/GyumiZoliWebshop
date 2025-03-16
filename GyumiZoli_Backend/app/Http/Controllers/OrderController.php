<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        
        $items = json_encode($request->input('items'), JSON_UNESCAPED_UNICODE);

        $order = Order::create([
            'user_id' => $request->input('user_id'),
            'items' => $items, 
            'totalPrice' => $request->input('totalPrice'),
            'customers_name' => $request->input('customers_name'),
            'customers_phone' => $request->input('customers_phone'),
            'delivery_address' => $request->input('delivery_address'),
            'payment_method' => $request->input('payment_method'),
            'status' => $request->input('status'),
            'delivery_date' => $request->input('delivery_date')
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

    public function getOneOrder(Request $request)
    {
        $order = Order::where('user_id',$request->user_id)->first();
        if (!$order) {
            return response()->json("Nem található a megrendelés!");
        }
        return response()->json($order);
    }

    public function updateOrder(Request $request)
    {
        $order = Order::find($request["id"]);
        if (!$order) {
            return response()->json("Nem található a megrendelés!");
        }


        $order->update([
            'totalPrice' => $request->input('totalPrice'),
            'customers_name' => $request->input('customers_name'),
            'customers_phone' => $request->input('customers_phone'),
            'delivery_address' => $request->input('delivery_address'),
            'payment_method' => $request->input('payment_method'),
            'status' => $request->input('status'),
            'delivery_date' => $request->input('delivery_date')
        ]);

        return response()->json(['message' => 'Megrendelés sikeresen frissítve!', 'order' => $order], 200);
    }
    
}

