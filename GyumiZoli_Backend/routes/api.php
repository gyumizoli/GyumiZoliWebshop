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

Route::resource('users', UserController::class);
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('promotions', PromotionController::class);
Route::resource('orders', OrderController::class);
Route::resource('order_items', OrderItemController::class);
Route::resource('inventories', InventoryController::class);
Route::resource('shipping_details', ShippingDetailController::class);
Route::resource('purchase_histories', PurchaseHistoryController::class);
