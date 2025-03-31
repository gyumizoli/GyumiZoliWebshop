<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\BannerController;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\PersonalAccessToken;




class UserController extends ResponseController
{

     public function register(Request $request ) {

        $user = User::create([

            "name" => $request["name"],
            "email" => $request["email"],
            "password" => bcrypt( $request["password"]),
            "phone" => $request["phone"],
            "address" => $request["address"],
            "birth_date" => $request["birth_date"],
            "admin" => 0
        ]);

        return $this->sendResponse( $user->name, "Sikeres regisztráció");
    }

    public function login(Request $request){

        
        if(Auth::attempt(["email" => $request["email"], "password" => $request["password"]])){
            $user = Auth::user();
            $token = $user->createToken($user->name."Token")->plainTextToken;
            $data =[
                "user" => $user->name,
                "token" => $token
            ];
            return $this->sendResponse($data, "Sikeres bejelentkezés");
        }else{
            return $this->sendError("Authentikációs hiba", ["Hibás felhasználónév vagy jelszó"], 401);
        }
    }



    public function logout() {

        auth( "sanctum" )->user()->currentAccessToken()->delete();
        $name = auth( "sanctum" )->user()->name;

        return $this->sendResponse( $name, "Sikeres kijelentkezés");


    }

    public function getUser(Request $request){
        $token = $request->bearerToken();
        if(!$token){
            return $this->sendError("Hibás token", ["Nincs token"], 401);
        }
        $tokenRecord = PersonalAccessToken::findToken($token);
        if(!$tokenRecord){
            return $this->sendError("Hibás token", ["Hibás token"], 401);
        }
        $user = $tokenRecord->tokenable;
        return $this->sendResponse($user, "Felhasználó adatai");

    }

    public function changePassword(Request $request) {
        $user = Auth::user();
    
        if (!$user) {
            return $this->sendError("Hiba", ["A felhasználó nem található vagy nem bejelentkezett"], 401);
        }
    
        if (!Hash::check($request->old_password, $user->password)) {
            return $this->sendError("Hibás jelszó", ["A régi jelszó nem megfelelő"], 401);
        }
    
    
        $user->password = bcrypt($request->new_password);
        $user->save();
    
        return $this->sendResponse($user->name, "Jelszó sikeresen megváltoztatva");
    }
    
    
    public function changeAddress(Request $request) {
        $user = Auth::user();

        if (!$user) {
            return $this->sendError("Hiba", ["A felhasználó nem található vagy nem bejelentkezett"], 401);
        }

        if (empty($request->new_address)) {
            return $this->sendError("Hibás cím", ["Az új cím nem lehet üres"], 400);
        }

        $user->address = $request->new_address;
        $user->save();

        return $this->sendResponse($user->name, "Cím sikeresen megváltoztatva");
    }
    

}
