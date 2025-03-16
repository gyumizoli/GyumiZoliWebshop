<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\BannerMail;
use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{
    public function sendBannerMail($userName,$bannedTime){
        $content = [
            "title" => "Felhasználó blokkolása",
            "user" => $userName,
            "time"=> $bannedTime
            
        ];
        Mail::to("")-> send(new BannerMail($content));

    }
    public function sendOrderConfirmationMail($userEmail, $orderDetails){
        $content = [
            "title" => "Order Confirmation",
            "orderDetails" => $orderDetails
        ];
        Mail::to("")->send(new OrderConfirmationMail($content));
    }
    
}
