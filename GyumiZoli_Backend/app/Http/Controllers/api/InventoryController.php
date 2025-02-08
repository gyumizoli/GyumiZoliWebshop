<?php

namespace App\Http\Controllers;

use App\Models\Inventory; 
use App\Http\Requests\InventoryRequest; 
use Illuminate\Http\JsonResponse;

class InventoryController extends Controller
{
    
    public function getInventory()
    {
        return Inventory::all();
    }

   
    public function storeInventory(InventoryRequest $request)
    {
        return Inventory::create($request->validated());
    }

   
    public function showInventory(Inventory $inventory)
    {
        return $inventory;
    }

   
    public function updateInventory(InventoryRequest $request, Inventory $inventory)
    {
        $inventory->update($request->validated());
        return $inventory;
    }

   
    public function destroyInventory(Inventory $inventory)
    {
        $inventory->delete();
        return response()->json(['message' => 'Sikeres törlés!'], 204);
    }
}
