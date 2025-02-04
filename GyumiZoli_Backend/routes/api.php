<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ShippingDetailController;
use App\Http\Controllers\PurchaseHistoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users', [UserController::class,"getUser"]);
Route::post('/adduser', [UserController::class,"addUser"]);
Route::get('/usershow/{id}', [UserController::class,"showUser"]);
Route::put('/updateuser/{id}', [UserController::class,"updateUser"]);
Route::delete('/destroyuser/{id}', [UserController::class,"destroyUser"]);

Route::post('/newcategories', [CategoryController::class,"addCategory"]);
Route::get('/categories', [CategoryController::class,"getCategory"]);
Route::get('/categorieshow/{id}', [CategoryController::class,"showCategory"]);
Route::put('/categories/{id}', [CategoryController::class,"updateCategory"]);
Route::delete('/categoriesdestroy/{id}', [CategoryController::class,"destroyCategory"]);

Route::post('/getinventory', [InventoryController::class,"getInventory"]);
Route::post('/addinventory', [InventoryController::class,"addInventory"]);
Route::get('/inventoryshow/{id}', [InventoryController::class,"showInventory"]);
Route::put('/inventory/{id}', [InventoryController::class,"updateInventory"]);
Route::delete('/inventorydestroy/{id}', [InventoryController::class,"destroyInventory"]);

