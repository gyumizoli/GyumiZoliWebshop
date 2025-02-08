<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function getUsers(){
       
        if(!Gate::denies("user")){
            return $this->sendError("Authentikációs hiba!","Nincs jogosultság",401);
        }  
            $users = User::all();
            return $this->sendResponse($users,"Betöltve");

        
    }


    public function setAdmin(Request $request){

        if(!Gate::allows("super")){
            return $this->sendError("Authentikációs hiba!","Nincs jogosultság",401);
        }

        $user = User::find($request["id"]);
        $user->admin = 1;
        $user->update();
        return $this->sendResponse($user,"Admin jogosultság beállítva");

    
    }

    public function updateUsers( Request $request){
        if(!Gate::denies("user")){
            return $this->sendError("Authentikációs hiba!","Nincs jogosultság",401);
        }
        $user = User::find($request["id"]);
        $user->name = $request["name"];
        $user->email = $request["email"];
        $user->update();
        return $this->sendResponse($user,"Sikeres frissítés");
    }

    public function deleteUsers(){

    }
}
