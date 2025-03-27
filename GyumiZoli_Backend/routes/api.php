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

Route::post('/addorder', [OrderController::class,"createOrder"]);

Route::get('/products', [ProductController::class,"getProduct"]);
Route::get('/productshow', [ProductController::class,"showProduct"]);

Route::post('/successorder', [MailController::class, 'sendOrderConfirmationMail']);
Route::post('/successregistration', [MailController::class, 'sendRegistrationSuccessMail']);
Route::post('/changepasswordmail', [MailController::class, 'sendChangePasswordMail']);
Route::post('/changeemailmail', [MailController::class, 'sendChangeEmailMail']);
Route::post('/orderstatus', [MailController::class, 'sendOrderStatusMail']);


Route::middleware('auth:sanctum')->group(function () {

    Route::post('logout', [UserController::class,"logout"]);
   
    Route::post('/change-password', [UserController::class, 'changePassword']);
    Route::post('/change-email', [UserController::class, 'changeEmail']);

    Route::get('/orders', [OrderController::class,"getOrder"]);
    Route::post('/updateorder', [OrderController::class,"updateOrder"]);
    Route::delete('/orderdestroy',[OrderController::class,"deleteOrder"]);
    Route::get('/getcustomersorders', [OrderController::class,"getOrdersByUser"]);

    Route::put('/users/set-admin', [AuthController::class, 'setAdmin']);

    Route::get('/getuser', [UserController::class, 'getUser']);
    Route::get('/users', [AuthController::class, 'getUsers']);
    Route::put('/users/update', [AuthController::class, 'updateUsers']);
    Route::delete('/users/delete', [AuthController::class, 'destroyUser']);

    Route::post('/addproduct', [ProductController::class,"addProduct"]);
    Route::post('/updateproduct', [ProductController::class,"updateProduct"]);
    Route::delete('/productdestroy', [ProductController::class,"destroyProduct"]);
});