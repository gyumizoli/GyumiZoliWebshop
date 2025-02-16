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
Route::get('/inventoryshow/{inventory}', [InventoryController::class,"showInventory"]);
Route::put('/inventory/{inventory}', [InventoryController::class,"updateInventory"]);
Route::delete('/inventorydestroy/{inventory}', [InventoryController::class,"destroyInventory"]);


Route::get('/orders', [OrderController::class,"getOrder"]);
Route::get('/ordershow/{order}', [OrderController::class,"showOrder"]);
Route::post('/addorder', [OrderController::class,"addOrder"]);

Route::get('/orderitems', [OrderItemController::class,"getOrderItem"]);
Route::get('/orderitemshow/{orderitem}', [OrderItemController::class,"showOrderItem"]);
Route::post('/addorderitem', [OrderItemController::class,"addOrderItem"]);
Route::put('/orderitem/{orderitem}', [OrderItemController::class,"updateOrderItem"]);
Route::delete('/orderitemdestroy/{orderitem}', [OrderItemController::class,"destroyOrderItem"]);

Route::get('/shippingdetails', [ShippingDetailController::class,"getShippingDetails"]);
Route::get('/shippingdetailshow/{shippingdetail}', [ShippingDetailController::class,"showShippingDetail"]);
Route::post('/addshippingdetail', [ShippingDetailController::class,"addShippingDetail"]);
Route::put('/shippingdetail/{shippingdetail}', [ShippingDetailController::class,"updateShippingDetail"]);
Route::delete('/shippingdetaildestroy/{shippingdetail}', [ShippingDetailController::class,"destroyShippingDetail"]);

Route::get('/purchasehistories', [PurchaseHistoryController::class,"getPurchaseHistories"]);
Route::get('/purchasehistoryshow/{purchasehistory}', [PurchaseHistoryController::class,"showPurchaseHistory"]);
Route::post('/addpurchasehistory', [PurchaseHistoryController::class,"addPurchaseHistory"]);
Route::put('/purchasehistory/{purchasehistory}', [PurchaseHistoryController::class,"updatePurchaseHistory"]);
Route::delete('/purchasehistorydestroy/{purchasehistory}', [PurchaseHistoryController::class,"destroyPurchaseHistory"]);



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [AuthController::class, 'getUsers']);
    Route::post('/users/set-admin', [AuthController::class, 'setAdmin']);
    Route::put('/users/update', [AuthController::class, 'updateUsers']);
    Route::delete('/users/{user}', [AuthController::class, 'destroyUser ']);

    Route::post('/newcategories', [CategoryController::class,"addCategory"]);
    Route::get('/categories', [CategoryController::class,"getCategory"]);
    Route::get('/categorieshow/{category}', [CategoryController::class,"showCategory"]);
    Route::put('/categories/{category}', [CategoryController::class,"updateCategory"]);
    Route::delete('/categoriesdestroy/{category}', [CategoryController::class,"destroyCategory"]);
    Route::post('logout', [UserController::class,"logout"]);

    Route::get('/promotions', [PromotionController::class,"getPromotion"]);
    Route::get('/promotionshow/{promotion}', [PromotionController::class,"showPromotion"]);
    Route::post('/addpromotion', [PromotionController::class,"addPromotion"]);
    Route::put('/promotion/{promotion}', [PromotionController::class,"updatePromotion"]);
    Route::delete('/promotiondestroy/{promotion}', [PromotionController::class,"destroyPromotion"]);

    Route::get('/products', [ProductController::class,"getProduct"]);
    Route::get('/productshow/{product}', [ProductController::class,"showProduct"]);
    Route::post('/addproduct', [ProductController::class,"addProduct"]);
    Route::put('/product/{product}', [ProductController::class,"updateProduct"]);
    Route::delete('/productdestroy/{product}', [ProductController::class,"destroyProduct"]);

    Route::put('/order/{order}', [OrderController::class,"updateOrder"]);
    Route::delete('/orderdestroy/{order}', [OrderController::class,"destroyOrder"]);
});