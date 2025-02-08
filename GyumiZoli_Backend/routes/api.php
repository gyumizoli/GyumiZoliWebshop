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
use App\Http\Controllers\BannerController;
use App\Http\Controllers\AuthController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users', [AuthController::class,"getUsers"]);
Route::post('/adduser', [UserController::class,"addUser"]);
Route::get('/usershow/{user}', [UserController::class,"showUser"]);
Route::put('/updateuser/{user}', [UserController::class,"updateUser"]);
Route::delete('/destroyuser/{user}', [UserController::class,"destroyUser"]);

Route::post('/newcategories', [CategoryController::class,"addCategory"]);
Route::get('/categories', [CategoryController::class,"getCategory"]);
Route::get('/categorieshow/{category}', [CategoryController::class,"showCategory"]);
Route::put('/categoriesupdate/{category}', [CategoryController::class,"updateCategory"]);
Route::delete('/categoriesdestroy/{category}', [CategoryController::class,"destroyCategory"]);

Route::post('/getinventory', [InventoryController::class,"getInventory"]);
Route::post('/addinventory', [InventoryController::class,"addInventory"]);
Route::get('/inventoryshow/{inventory}', [InventoryController::class,"showInventory"]);
Route::put('/inventory/{inventory}', [InventoryController::class,"updateInventory"]);
Route::delete('/inventorydestroy/{inventory}', [InventoryController::class,"destroyInventory"]);


Route::post('/neworder', [OrderController::class,"addOrder"]);
Route::get('/orders', [OrderController::class,"getOrder"]);
Route::get('/ordershow/{order}', [OrderController::class,"showOrder"]);
Route::put('/orderupdate/{order}', [OrderController::class,"updateOrder"]);
Route::delete('/orderdestroy/{order}', [OrderController::class,"destroyOrder"]);

