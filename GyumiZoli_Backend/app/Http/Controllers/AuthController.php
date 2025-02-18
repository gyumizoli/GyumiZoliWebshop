<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;


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

    public function destroyUser(User $user)
    {
        if (!Gate::allows("super")) {
            return $this->sendError("Authentikációs hiba!","Nincs jogosultság",401);
        }
        $user = User::find($request["id"]);
        $user->delete();
        return response()->json(null, 204); 
    }


    public function addUserAdmin(UserRequest $request){

        if(!Gate::allows("super")){
            return $this->sendError("Authentikációs hiba!","Nincs jogosultság",401);
        }
        $user = User::create($request->validated());
        return $this->sendResponse($user,"Felhasználó hozzáadva");
    }
}
