<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\BannerController;
use Illuminate\Support\Facades\DB;




class UserController extends ResponseController
{

     public function register( Request $request ) {


        $user = User::create([

            "name" => $request["name"],
            "email" => $request["email"],
            "password" => bcrypt( $request["password"]),
            "phone" => $request["phone"],
            "address" => $request["address"],
            "birth_date" => $request["birth_date"],
            "admin" => $request["admin"]
        ]);

        return $this->sendResponse( $user->name, "Sikeres regisztráció");
    }

    public function login( UserLoginRequest $request ) {

        $request->validated();

        if( Auth::attempt([ "email" => $request["email"], "password" => $request["password"]])) {

            $actualTime = Carbon::now();
            $authUser = Auth::user();
            $bannedTime = ( new BannerController )->getBannedTime( $authUser->email );
            ( new BannerController )->reSetLoginCounter( $authUser->email );

            if( $bannedTime < $actualTime ) {

                (new BannerController)->setBannedTime( $authUser->email );

                $token = $authUser->createToken( $authUser->email."Token" )->plainTextToken;
                $data["user"] = [ "user" => $authUser->email ];
                $data[ "time" ] = $bannedTime;
                $data["token"] = $token;
                return $this->sendResponse($data,"Sikeres bejelentkezés");
            }
            else
            {
                return $this->sendError("Authentikációs hiba",["Következő lehetőség: ".$bannedTime],401);
            }
        }else {

            $loginCounter = ( new BannerController )->getLoginCounter( $request[ "email" ]);
            if( $loginCounter < 3 ) {

                ( new BannerController )->setLoginCounter( $request[ "email" ]);

            }else {

                ( new BannerController )->setBannedTime( $request[ "email" ]);
                $bannedtime = ( new BannerController )->getBannedTime( $request[ "email" ]);
                (new MailController)->sendMail();
            }
            
            $errorMessage = [ "message" => "Következő lehetőségig: ".$bannedtime ];
            return $this->sendError( $error, [$errorMessage], 401 );
        }
    }

    public function logout() {

        auth( "sanctum" )->user()->currentAccessToken()->delete();
        $name = auth( "sanctum" )->user()->name;

        return $this->sendResponse( $name, "Sikeres kijelentkezés");


    }

    public function getTokens(){
        $tokens = DB::table("personal_access_tokens")->get();
        return $tokens;
    }

}
