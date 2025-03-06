<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Illuminate\Http\Response;

class OrderController extends ResponseController
{
    public function getOrder()
    {
        $orders = Order::with(['user', 'orderItems.product', 'shippingDetails'])->get();
        return response()->json('Rendelések sikeresen lekérve.');
    }

    public function storeOrder(OrderRequest $request)
    {
        $order = Order::create($request->validated());
        $order->load(['user', 'orderItems.product', 'shippingDetails']);
        return response()->json('Rendelés sikeresen létrehozva.');
    }

    public function showOrder(Order $order)
    {
        $order->load(['user', 'orderItems.product', 'shippingDetails']);
        return response()->json('Rendelés sikeresen lekérve.');
    }

    public function updateOrder(OrderRequest $request, Order $order)
    {
        $order->update($request->validated());
        $order->load(['user', 'orderItems.product', 'shippingDetails']);
        return response()->json('Rendelés sikeresen frissítve.');
    }

    public function destroyOrder(Order $order)
    {
        $order->delete();
        return response()->json('Rendelés sikeresen törölve.');
    }
}

