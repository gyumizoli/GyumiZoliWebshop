<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ResponseController;
use App\Http\Requests\ShippingDetailRequest;
use App\Models\ShippingDetail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ShippingDetailController extends ResponseController
{
    public function createShippingDetail(Request $request)
    {
       

        $shippingDetail = ShippingDetail::create([
            'order_id' => $request->input('order_id'),
            'customers_name' => $request->input('customers_name'),
            'customers_phone' => $request->input('customers_phone'),
            'shipping_address' => $request->input('shipping_address'),
            'status' => $request->input('status'),
            'shipping_date' => $request->input('shipping_date'),
            'delivery_date' => $request->input('delivery_date'),
        ]);

        return response()->json($shippingDetail, 'Szállítási adatok sikeresen létrehozva!', Response::HTTP_CREATED);
    }

    public function getShippingDetail(): JsonResponse
    {
        $shippingDetail = ShippingDetail::all();
        return response()->json($shippingDetail, 'Szállítási adatok lekérdezve!');
    }

    public function deleteShippingDetail(int $id): JsonResponse
    {
        $shippingDetail = ShippingDetail::find($id);
        if (!$shippingDetail) {
            return response()->json('Nem található a szállítási adatok!', [], Response::HTTP_NOT_FOUND);
        }
        $shippingDetail->delete();
        return response()->json(null, 'Szállítási adatok törölve!');
    }
}
