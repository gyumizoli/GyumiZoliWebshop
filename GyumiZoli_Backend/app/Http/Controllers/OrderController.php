<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    
    public function getOrder()
    {
        $orders = Order::with(['user', 'orderItems', 'shippingDetails'])->get();
        return $this->successResponse($orders);
    }

    
    public function storeOrder(OrderRequest $request)
    {
        $order = Order::create($request->validated());
        return $this->successResponse($order, Response::HTTP_CREATED);
    }

   
    public function showOrder(Order $order)
    {
        $order->load(['user', 'orderItems', 'shippingDetails']);
        return $this->successResponse($order);
    }

   
    public function updateOrder(OrderRequest $request, Order $order)
    {
        $order->update($request->validated());
        return $this->Response($order);
    }

   
    public function destroyOrder(Order $order)
    {
        $order->delete();
        return response()->json([
            'success' => true,
            'message' => 'Order deleted successfully.',
        ], Response::HTTP_NO_CONTENT);
    }

   
   
}
