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
        return response()->json( 'Orders retrieved successfully.');
    }

    public function storeOrder(OrderRequest $request)
    {
        $order = Order::create($request->validated());
        $order->load(['user', 'orderItems.product', 'shippingDetails']);
        return response()->json( 'Order created successfully.', );
    }

    public function showOrder(Order $order)
    {
        $order->load(['user', 'orderItems.product', 'shippingDetails']);
        return response()->json('Order retrieved successfully.');
    }

    public function updateOrder(OrderRequest $request, Order $order)
    {
        $order->update($request->validated());
        $order->load(['user', 'orderItems.product', 'shippingDetails']);
        return response()->json(['Order updated successfully.']);
    }

    public function destroyOrder(Order $order)
    {
        $order->delete();
        return response()->json('Order deleted successfully.');
    }
}

