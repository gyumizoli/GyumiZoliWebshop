<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\ResponseController;
use App\Http\Requests\ShippingDetailRequest;
use App\Models\ShippingDetail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ShippingDetailController extends ResponseController
{
    public function getShippingDetails()
    {
        $shippingDetails = ShippingDetail::with(['order'])->get();
        return $this->sendResponse($shippingDetails, 'Shipping details retrieved successfully.');
    }

    public function addShippingDetail(ShippingDetailRequest $request) 
    {
        $shippingDetail = ShippingDetail::create($request->validated());
        return $this->sendResponse($shippingDetail, 'Shipping detail created successfully.');
    }

    public function showShippingDetail(ShippingDetail $shippingDetail)
    {
        return $this->sendResponse($shippingDetail, 'Shipping detail retrieved successfully.');
    }

    public function updateShippingDetail(ShippingDetailRequest $request, ShippingDetail $shippingDetail)
    {
        $shippingDetail->update($request->validated());
        return $this->sendResponse($shippingDetail, 'Shipping detail updated successfully.');
    }

    public function destroyShippingDetail(ShippingDetail $shippingDetail)
    {
        $shippingDetail->delete();
        return $this->sendResponse(null, 'Shipping detail deleted successfully.');
    }
}