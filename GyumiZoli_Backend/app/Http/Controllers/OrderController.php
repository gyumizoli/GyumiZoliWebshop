<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    public function createOrder(OrderRequest $request)
    {

        $items = $request->input('items'); 

       
        foreach ($items as $item) {
            $product = Product::find($item['product']['id']);
            if ($product && $product->stock < $item['quantity']) {
                return response()->json(['error' => 'Nincs elegendő készlet a termékhez: ' . $product->name], 400);
            }
        }

    
        $order = Order::create([
            'user_id' => $request->input('user_id'),
            'items' => json_encode($items, JSON_UNESCAPED_UNICODE), 
            'totalPrice' => $request->input('totalPrice'),
            'customers_name' => $request->input('customers_name'),
            'customers_phone' => $request->input('customers_phone'),
            'customers_email' => $request->input('customers_email'),
            'delivery_address' => $request->input('delivery_address'),
            'payment_method' => $request->input('payment_method'),
            'status' => $request->input('status'),
            'delivery_date' => $request->input('delivery_date')
        ]);

      
        foreach ($items as $item) {
            $product = Product::find($item['product']['id']);
            if ($product) {
                $product->decrement('stock', $item['quantity']);
            }
        }

        return response()->json(['message' => 'Megrendelés sikeresen létrehozva!', 'order' => $order], 201);
    }
    public function getOrder()
    {
        $order = Order::all();
        return response()->json($order);
    }

    public function deleteOrder(Request $request)
    {
        if (!Gate::allows("admin")) {
            return response()->json(["error" => "Authentikációs hiba!", "message" => "Nincs jogosultság"]);
        }

        $order = Order::find($request->id);
        if (!$order) {
            return response()->json("Nem található a megrendelés!");
        }
        $order->delete();
        return response()->json("Megrendelés törölve!");
    }


    public function updateOrder(Request $request)
    {
        if (!Gate::allows("admin")) {
            return response()->json(["error" => "Authentikációs hiba!", "message" => "Nincs jogosultság"]);
        }

        $order = Order::find($request->input('id'));
        if (!$order) {
            return response()->json("Nem található a megrendelés!");
        }

        $order->totalPrice = $request->input('totalPrice');
        $order->customers_name = $request->input('customers_name');
        $order->customers_phone = $request->input('customers_phone');
        $order->delivery_address = $request->input('delivery_address');
        $order->payment_method = $request->input('payment_method');
        $order->status = $request->input('status');
        $order->delivery_date = $request->input('delivery_date');

        $order->save();

        return response()->json(['message' => 'Megrendelés sikeresen frissítve!', 'order' => $order], 200);
    }

    public function getOrdersByUser(Request $request)
    {
        $orders = Order::where('user_id', $request->user_id)->get();
        if ($orders->isEmpty()) {
            return response()->json("Nem találhatóak megrendelések a megadott felhasználóhoz!");
        }
        return response()->json($orders);
    }

    
}
