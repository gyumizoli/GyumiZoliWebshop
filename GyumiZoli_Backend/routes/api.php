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

Route::post('login', [UserController::class,"login"]);
Route::post('register', [UserController::class,"register"]);

Route::post('/getinventory', [InventoryController::class,"getInventory"]);
Route::post('/addinventory', [InventoryController::class,"addInventory"]);
Route::get('/inventoryshow', [InventoryController::class,"showInventory"]);
Route::put('/updateinventory', [InventoryController::class,"updateInventory"]);
Route::delete('/inventorydestroy', [InventoryController::class,"destroyInventory"]);


Route::get('/orders', [OrderController::class,"getOrder"]);
Route::get('/ordershow/{order}', [OrderController::class,"showOrder"]);
Route::post('/addorder', [OrderController::class,"addOrder"]);

Route::get('/orderitems', [OrderItemController::class,"getOrderItem"]);
Route::get('/orderitemshow', [OrderItemController::class,"showOrderItem"]);
Route::post('/addorderitem', [OrderItemController::class,"addOrderItem"]);
Route::put('/updateorderitem', [OrderItemController::class,"updateOrderItem"]);
Route::delete('/orderitemdestroy', [OrderItemController::class,"destroyOrderItem"]);

Route::get('/shippingdetails', [ShippingDetailController::class,"getShippingDetails"]);
Route::get('/shippingdetailshow', [ShippingDetailController::class,"showShippingDetail"]);
Route::post('/addshippingdetail', [ShippingDetailController::class,"addShippingDetail"]);
Route::put('/updateshippingdetail', [ShippingDetailController::class,"updateShippingDetail"]);
Route::delete('/shippingdetaildestroy', [ShippingDetailController::class,"destroyShippingDetail"]);

Route::get('/purchasehistories', [PurchaseHistoryController::class,"getPurchaseHistories"]);
Route::get('/purchasehistoryshow/{purchasehistory}', [PurchaseHistoryController::class,"showPurchaseHistory"]);
Route::post('/addpurchasehistory', [PurchaseHistoryController::class,"addPurchaseHistory"]);
Route::put('/purchasehistory/{purchasehistory}', [PurchaseHistoryController::class,"updatePurchaseHistory"]);
Route::delete('/purchasehistorydestroy/{purchasehistory}', [PurchaseHistoryController::class,"destroyPurchaseHistory"]);

Route::get('/users', [AuthController::class, 'getUsers']);
Route::put('/users/set-admin', [AuthController::class, 'setAdmin']);
Route::put('/users/update', [AuthController::class, 'updateUsers']);
Route::delete('/users/delete', [AuthController::class, 'destroyUser']);

Route::post('/newcategories', [CategoryController::class,"addCategory"]);
Route::get('/categories', [CategoryController::class,"getCategory"]);
Route::get('/categorieshow', [CategoryController::class,"showCategory"]);
Route::put('/updatecategories', [CategoryController::class,"updateCategory"]);
Route::delete('/categoriesdestroy', [CategoryController::class,"destroyCategory"]);
Route::post('logout', [UserController::class,"logout"]);

Route::get('/promotions', [PromotionController::class,"getPromotion"]);
Route::get('/promotionshow', [PromotionController::class,"showPromotion"]);
Route::post('/addpromotion', [PromotionController::class,"addPromotion"]);
Route::put('/updatepromotion', [PromotionController::class,"updatePromotion"]);
Route::delete('/promotiondestroy', [PromotionController::class,"destroyPromotion"]);

Route::get('/products', [ProductController::class,"getProduct"]);
Route::get('/productshow', [ProductController::class,"showProduct"]);
Route::post('/addproduct', [ProductController::class,"addProduct"]);
Route::post('/updateproduct', [ProductController::class,"updateProduct"]);
Route::delete('/productdestroy', [ProductController::class,"destroyProduct"]);

Route::put('/order', [OrderController::class,"updateOrder"]);
Route::delete('/orderdestroy', [OrderController::class,"destroyOrder"]);


Route::middleware('auth:sanctum')->group(function () {
    
});