<?php

namespace App\Http\Controllers;

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
        return $this->sendResponse($shippingDetails, "Szállítási részletek sikeresen lekérve.");
        }

        public function addShippingDetail(ShippingDetailRequest $request) 
        {
        $shippingDetail = ShippingDetail::create($request->validated());
        return $this->sendResponse($shippingDetail, "Szállítási részlet sikeresen létrehozva.");
        }

        public function showShippingDetail(ShippingDetail $shippingDetail)
        {
        return $this->sendResponse($shippingDetail, "Szállítási részlet sikeresen lekérve.");
        }

        public function updateShippingDetail(ShippingDetailRequest $request, ShippingDetail $shippingDetail)
        {
        $shippingDetail->update($request->validated());
        return $this->sendResponse($shippingDetail, "Szállítási részlet sikeresen frissítve.");
        }

        public function destroyShippingDetail(ShippingDetail $shippingDetail)
        {
        $shippingDetail->delete();
        return $this->sendResponse(null, "Szállítási részlet sikeresen törölve.");
        }
    }
