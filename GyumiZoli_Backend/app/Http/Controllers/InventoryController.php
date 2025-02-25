<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ResponseController;
use App\Models\Inventory; 
use App\Http\Requests\InventoryRequest; 
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class InventoryController extends ResponseController
{
    public function getInventory()
    {
        $inventoryItems = Inventory::all();
        return $this->sendResponse($inventoryItems, 'Inventory items retrieved successfully.');
    }

    public function addInventory(InventoryRequest $request)
    {
        $inventoryItem = Inventory::create($request->validated());
        return $this->sendResponse($inventoryItem, 'Inventory item created successfully.');
    }

    public function showInventory(Inventory $inventory)
    {
        return $this->sendResponse($inventory, 'Inventory item retrieved successfully.');
    }

    public function updateInventory(InventoryRequest $request, Inventory $inventory)
    {
        $inventory->update($request->validated());
        return $this->sendResponse($inventory, 'Inventory item updated successfully.');
    }

    public function destroyInventory(Inventory $inventory)
    {
        $inventory->delete();
        return $this->sendResponse(null, 'Inventory item deleted successfully.');
    }
}
