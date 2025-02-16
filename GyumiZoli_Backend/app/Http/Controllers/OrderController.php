<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Illuminate\Http\Response;

class OrderController extends ResponseController
{
    public function getOrder()
    {
        $orders = Order::with(['user', 'orderItems', 'shippingDetails'])->get();
        return $this->sendResponse($orders, 'Orders retrieved successfully.');
    }

    public function storeOrder(OrderRequest $request)
    {
        $order = Order::create($request->validated());
        return $this->sendResponse($order, 'Order created successfully.', Response::HTTP_CREATED);
    }

    public function showOrder(Order $order)
    {
        $order->load(['user', 'orderItems', 'shippingDetails']);
        return $this->sendResponse($order, 'Order retrieved successfully.');
    }

    public function updateOrder(OrderRequest $request, Order $order)
    {
        $order->update($request->validated());
        return $this->sendResponse($order, 'Order updated successfully.');
    }

    public function destroyOrder(Order $order)
    {
        $order->delete();
        return $this->sendResponse(null, 'Order deleted successfully.');
    }
}

