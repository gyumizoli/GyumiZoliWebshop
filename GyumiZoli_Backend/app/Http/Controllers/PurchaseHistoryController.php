<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ResponseController;
use App\Http\Requests\PurchaseHistoryRequest;
use App\Models\PurchaseHistory;
use Illuminate\Http\Response;

class PurchaseHistoryController extends ResponseController
{
    public function createPurchaseHistory(PurchaseHistoryRequest $request)
    {
        $purchaseHistory = PurchaseHistory::create([
            'user_id' => $request->input('user_id'),
            'product_id' => $request->input('product_id'),
            'quantity' => $request->input('quantity'),
            'total_price' => $request->input('total_price'),
            'purchase_date' => $request->input('purchase_date'),
        ]);

        return response()->json($purchaseHistory, 'Vásárlási előzmények sikeresen létrehozva!', Response::HTTP_CREATED);
    }

    public function getPurchaseHistory(): JsonResponse
    {
        $purchaseHistory = PurchaseHistory::all();
        return response()->json($purchaseHistory, 'Vásárlási előzmények lekérdezve!');
    }

    public function deletePurchaseHistory(int $id): JsonResponse
    {
        $purchaseHistory = PurchaseHistory::find($id);
        if (!$purchaseHistory) {
            return response()->json('Nem található a vásárlási előzmények!', [], Response::HTTP_NOT_FOUND);
        }
        $purchaseHistory->delete();
        return response()->json(null, 'Vásárlási előzmények törölve!');
    }
}
