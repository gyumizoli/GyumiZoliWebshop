<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\BannerMail;
use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{
    public function sendMail($userName,$bannedTime){
        $content = [
            "title" => "Felhasználó blokkolása",
            "user" => $userName,
            "time"=> $bannedTime
            
        ];
        Mail::to("")-> send(new BannerMail($content));

    }
    
}
