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
            'payment_method' => $request->input('payment_method'),
            'status' => $request->input('status'),
            'shipping_date' => $request->input('shipping_date'),
            'delivery_date' => $request->input('delivery_date'),
        ]);

       
        if (!$request->input('order_id')) {
            $shippingDetail->delete_at = now()->addDays(30); 
            $shippingDetail->save();
        }

        return response()->json($shippingDetail, 'Szállítási adatok sikeresen létrehozva!');
    }

    public function cancelOrder(Request $request) 
    {
        $shippingDetail = ShippingDetail::find($id);
        if (!$shippingDetail) {
            return response()->json('Nem található a szállítási adatok!');
        }
        $shippingDetail->delete();
        return response()->json('A rendelés törölve lett a folyamat közepén!');
    }

    public function getShippingDetail(): JsonResponse
    {
        $shippingDetail = ShippingDetail::all();
        return response()->json($shippingDetail, 'Szállítási adatok lekérdezve!');

    }

    public function updateShippingDetail(Request $request)
    {
        $shippingDetail = ShippingDetail::find($id);
        if (!$shippingDetail) {
            return response()->json('Nem található a szállítási adatok!');
        }
        $shippingDetail->update($request->all());
        return response()->json($shippingDetail, 'Szállítási adatok frissítve!');
    }

    public function deleteShippingDetail(int $id): JsonResponse
    {
        $shippingDetail = ShippingDetail::find($id);
        if (!$shippingDetail) {
            return response()->json('Nem található a szállítási adatok!');
        }
        $shippingDetail->delete();
        return response()->json( 'Szállítási adatok törölve!');
    }
}
