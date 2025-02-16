<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\ResponseController;
use App\Http\Requests\PurchaseHistoryRequest;
use App\Models\PurchaseHistory;
use Illuminate\Http\Response;

class PurchaseHistoryController extends ResponseController
{
    public function getPurchaseHistories()
    {
        $purchaseHistories = PurchaseHistory::with(['user', 'product'])->get();
        return $this->sendResponse($purchaseHistories, 'Purchase histories retrieved successfully.');
    }

    public function addPurchaseHistory(PurchaseHistoryRequest $request)
    {
        $purchaseHistory = PurchaseHistory::create($request->validated());
        return $this->sendResponse($purchaseHistory, 'Purchase history created successfully.', Response::HTTP_CREATED);
    }

    public function showPurchaseHistory(PurchaseHistory $purchaseHistory)
    {
        return $this->sendResponse($purchaseHistory, 'Purchase history retrieved successfully.');
    }

    public function updatePurchaseHistory(PurchaseHistoryRequest $request, PurchaseHistory $purchaseHistory)
    {
        $purchaseHistory->update($request->validated());
        return $this->sendResponse($purchaseHistory, 'Purchase history updated successfully.');
    }

    public function destroyPurchaseHistory(PurchaseHistory $purchaseHistory)
    {
        $purchaseHistory->delete();
        return $this->sendResponse(null, 'Purchase history deleted successfully.');
    }
}
