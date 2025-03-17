<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MailController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login', [UserController::class,"login"]);
Route::post('register', [UserController::class,"register"]);
Route::post('logout', [UserController::class,"logout"]);
Route::get('/getuser', [UserController::class, 'getUser']);
Route::get('/users', [AuthController::class, 'getUsers']);
Route::put('/change-password', [AuthController::class, 'changePassword']);


Route::get('/orders', [OrderController::class,"getOrder"]);
Route::get('/ordershow/{order}', [OrderController::class,"showOrder"]);
Route::post('/addorder', [OrderController::class,"createOrder"]);
Route::delete('/orderdestroy',[OrderController::class,"deleteOrder"]);
Route::get('/oneorder', [OrderController::class,"getOneOrder"]);
Route::post('/updateorder', [OrderController::class,"updateOrder"]);
Route::get('/getcustomersorders', [OrderController::class,"getOrdersByUser"]);


Route::put('/users/set-admin', [AuthController::class, 'setAdmin']);
Route::put('/users/update', [AuthController::class, 'updateUsers']);
Route::delete('/users/delete', [AuthController::class, 'destroyUser']);

Route::get('/products', [ProductController::class,"getProduct"]);
Route::get('/productshow', [ProductController::class,"showProduct"]);
Route::post('/addproduct', [ProductController::class,"addProduct"]);
Route::post('/updateproduct', [ProductController::class,"updateProduct"]);
Route::delete('/productdestroy', [ProductController::class,"destroyProduct"]);



Route::post('/sendbannermail', [MailController::class, 'sendMail']);
Route::post('/sendorderconfirmationmail', [MailController::class, 'sendOrderConfirmationMail']);




Route::middleware('auth:sanctum')->group(function () {
    
});