<?php

namespace App\Http\Controllers;

use App\Models\Inventory; 
use App\Http\Requests\InventoryRequest; 
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class InventoryController extends Controller
{
  
    public function getInventory(): JsonResponse
    {
        $inventoryItems = Inventory::all();
        return response()->json([
            'success' => true,
            'data' => $inventoryItems,
        ], Response::HTTP_OK);
    }

   
    public function addInventory(InventoryRequest $request): JsonResponse
    {
        $inventoryItem = Inventory::create($request->validated());
        return response()->json([
            'success' => true,
            'data' => $inventoryItem,
        ], Response::HTTP_CREATED);
    }

    
    public function showInventory(Inventory $inventory): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $inventory,
        ], Response::HTTP_OK);
    }

    
    public function updateInventory(InventoryRequest $request, Inventory $inventory)
    {
        $inventory->update($request->validated());
        return response()->json([
            'success' => true,
            'data' => $inventory,
        ], Response::HTTP_OK);
    }

   
    public function destroyInventory(Inventory $inventory){
        $inventory->delete();
        return response()->json([
            'success' => true,
            'message' => 'Inventory item deleted successfully.',
        ], Response::HTTP_NO_CONTENT);
    }
}
