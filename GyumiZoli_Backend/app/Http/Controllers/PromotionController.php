<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Http\Requests\PromotionRequest;
use Illuminate\Support\Facades\Validator;

class PromotionController extends Controller
{
    
    public function getPromotion()
    {
        $promotions = Promotion::all();
        return response()->json($promotions);
    }

  
    public function addPromotion(PromotionRequest $request)
    {
        $promotion = Promotion::create($request->validated());
        return response()->json($promotion, 201);
    }

   
    public function showPromotion($id)
    {
        $promotion = Promotion::findOrFail($id);
        return response()->json($promotion);
    }

 
    public function updatePromotion(PromotionRequest $request, $id)
    {
        $promotion = Promotion::findOrFail($id);
        $promotion->update($request->validated());
        return response()->json($promotion);
    }

    public function destroyPromotion($id)
    {
        $promotion = Promotion::findOrFail($id);
        $promotion->delete();
        return response()->json(null, 204);
    }
}
