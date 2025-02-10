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

Route::get('/users', [UserController::class,"getUser"]);
Route::post('/adduser', [UserController::class,"addUser"]);
Route::get('/usershow/{user}', [UserController::class,"showUser"]);
Route::put('/updateuser/{user}', [UserController::class,"updateUser"]);
Route::delete('/destroyuser/{user}', [AuthController::class,"destroyUser"]);

Route::post('/newcategories', [CategoryController::class,"addCategory"]);
Route::get('/categories', [CategoryController::class,"getCategory"]);
Route::get('/categorieshow/{category}', [CategoryController::class,"showCategory"]);
Route::put('/categories/{category}', [CategoryController::class,"updateCategory"]);
Route::delete('/categoriesdestroy/{category}', [CategoryController::class,"destroyCategory"]);

Route::post('/getinventory', [InventoryController::class,"getInventory"]);
Route::post('/addinventory', [InventoryController::class,"addInventory"]);
Route::get('/inventoryshow/{inventory}', [InventoryController::class,"showInventory"]);
Route::put('/inventory/{inventory}', [InventoryController::class,"updateInventory"]);
Route::delete('/inventorydestroy/{inventory}', [InventoryController::class,"destroyInventory"]);


Route::post('login', [UserController::class,"login"]);
Route::post('register', [UserController::class,"register"]);
Route::post('logout', [UserController::class,"logout"]);


Route::get('/products', [ProductController::class,"getProduct"]);
Route::get('/productshow/{product}', [ProductController::class,"showProduct"]);
Route::post('/addproduct', [ProductController::class,"addProduct"]);
Route::put('/product/{product}', [ProductController::class,"updateProduct"]);
Route::delete('/productdestroy/{product}', [ProductController::class,"destroyProduct"]);

Route::get('/promotions', [PromotionController::class,"getPromotion"]);
Route::get('/promotionshow/{promotion}', [PromotionController::class,"showPromotion"]);
Route::post('/addpromotion', [PromotionController::class,"addPromotion"]);
Route::put('/promotion/{promotion}', [PromotionController::class,"updatePromotion"]);
Route::delete('/promotiondestroy/{promotion}', [PromotionController::class,"destroyPromotion"]);

