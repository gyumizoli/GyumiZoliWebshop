<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;


class AuthController extends ResponseController
{
    public function getUsers(){
        
            $users = User::all();
            return response()->json($users);

        
    }


    public function setAdmin(Request $request){

        // if(!Gate::allows("super")){
        //     return $this->sendError("Authentikációs hiba!","Nincs jogosultság",401);
        // }

        $user = User::find($request["id"]);
        $user->admin = $request["admin"];
        $user->update();
        return response()->json($user);

    
    }

    public function updateUsers( Request $request){
        // if(!Gate::denies("user")){
        //     return $this->sendError("Authentikációs hiba!","Nincs jogosultság",401);
        // }
        $user = User::find($request["id"]);
        $user->name = $request["name"];
        $user->email = $request["email"];
        $user->birth_date = $request["birth_date"];
        $user->address = $request["address"];
        $user->phone = $request["phone"];
        $user->update();
        return response()->json($user);
    }

    public function destroyUser(Request $request)
    {
        // if (!Gate::allows("super")) {
        //     return $this->sendError("Authentikációs hiba!","Nincs jogosultság",401);
        // }
        $user = User::find($request["id"]);
        $user->delete();
        return response()->json($user); 
    }


    public function addUserAdmin(Request $request){

        // if(!Gate::allows("super")){
        //     return $this->sendError("Authentikációs hiba!","Nincs jogosultság",401);
        // }
        // $user = User::create($request->validated());
        $user = User::find($request["id"]);
        $user->admin=$request["admin"];
        $user->update();
        return response()->json($user);
    }
}
