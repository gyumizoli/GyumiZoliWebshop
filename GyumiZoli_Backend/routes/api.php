<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ShippingDetailController;
use App\Http\Controllers\PurchaseHistoryController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login', [UserController::class,"login"]);
Route::post('register', [UserController::class,"register"]);
Route::post('logout', [UserController::class,"logout"]);
Route::get('/getuser', [UserController::class, 'getUser']);
Route::get('/users', [AuthController::class, 'getUsers']);


Route::get('/orders', [OrderController::class,"getOrder"]);
Route::get('/ordershow/{order}', [OrderController::class,"showOrder"]);
Route::post('/addorder', [OrderController::class,"createOrder"]);
Route::delete('/orderdestroy',[OrderController::class,"deleteOrder"]);

Route::get('/addshippingdetail', [ShippingDetailController::class,"createShippingDetail"]);
Route::get('/getshippingdetail', [ShippingDetailController::class,"getShippingDetail"]);
Route::get('/deleteshippingdetail', [ShippingDetailController::class,"deleteShippingDetail"]);

Route::get('/purchasehistories', [PurchaseHistoryController::class,"getPurchaseHistories"]);
Route::get('/purchasehistoryshow/{purchasehistory}', [PurchaseHistoryController::class,"showPurchaseHistory"]);
Route::post('/addpurchasehistory', [PurchaseHistoryController::class,"addPurchaseHistory"]);
Route::put('/purchasehistory/{purchasehistory}', [PurchaseHistoryController::class,"updatePurchaseHistory"]);
Route::delete('/purchasehistorydestroy/{purchasehistory}', [PurchaseHistoryController::class,"destroyPurchaseHistory"]);

Route::put('/users/set-admin', [AuthController::class, 'setAdmin']);
Route::put('/users/update', [AuthController::class, 'updateUsers']);
Route::delete('/users/delete', [AuthController::class, 'destroyUser']);

Route::get('/products', [ProductController::class,"getProduct"]);
Route::get('/productshow', [ProductController::class,"showProduct"]);
Route::post('/addproduct', [ProductController::class,"addProduct"]);
Route::post('/updateproduct', [ProductController::class,"updateProduct"]);
Route::delete('/productdestroy', [ProductController::class,"destroyProduct"]);




Route::middleware('auth:sanctum')->group(function () {
    
});