<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\BannerMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;
use App\Mail\RegistrationSuccessMail;
use App\Mail\ChangePasswordMail;
use App\Mail\ChangeEmailMail;
use App\Mail\OrderStatusMail;


class MailController extends Controller
{
    public function sendOrderConfirmationMail(Request $request){
        $customers_email = $request["customers_email"];
        $customers_name = $request["customers_name"];
        $customers_phone = $request["customers_phone"];
        $delivery_address = $request["delivery_address"];
        $payment_method = $request["payment_method"] === 'card' ? 'Kártyával' : ($request["payment_method"] === 'cash' ? 'Készpénz' : $request["payment_method"]);
        $delivery_date = $request["delivery_date"];
        $totalPrice = $request["totalPrice"];
        $items = is_string($request["items"]) ? json_decode($request["items"], true) : $request["items"];

        $content = [
            "title" => "Rendelés visszaigazolás",
            "customers_name" => $customers_name,
            "customers_phone" => $customers_phone,
            "delivery_address" => $delivery_address,
            "payment_method" => $payment_method,
            "delivery_date" => $delivery_date,
            "totalPrice" => $totalPrice,
            'items' => $items
        ];
        Mail::to($customers_email)->send(new OrderConfirmationMail($content));
    }

    public function sendRegistrationSuccessMail(Request $request){
        $userName = $request["userName"];
        $userEmail = $request["userEmail"];
        $content = [
            "title" => "Üdvözöljük",
            "user" => $userName
        ];
        Mail::to($userEmail)->send(new RegistrationSuccessMail($content));
    }

    public function sendChangePasswordMail(Request $request){
        $userEmail = $request["email"];
        $userName = $request["name"];
        $content = [
            "title" => "Jelszó megváltoztatva",
            "user" => $userName
        ];
        Mail::to($userEmail)->send(new ChangePasswordMail($content));
    }

    public function sendChangeEmailMail(Request $request){
        $userEmail = $request["email"];
        $userName = $request["name"];
        $content = [
            "title" => "Email cím megváltoztatva",
            "user" => $userName
        ];
        Mail::to($userEmail)->send(new ChangeEmailMail($content));
    }

    public function sendOrderStatusMail(Request $request){
        $customers_email = $request["email"];
        $customers_name = $request["name"];
        $status = $request["status"];
        $delivery_date = $request["delivery_date"];
        $content = [
            "title" => "Rendelés állapota megváltoztatva",
            "name" => $customers_name,
            "status" => $status,
            "delivery_date" => $delivery_date
        ];
        Mail::to($customers_email)->send(new OrderStatusMail($content));
    }

}