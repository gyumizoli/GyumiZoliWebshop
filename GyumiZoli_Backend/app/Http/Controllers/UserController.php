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




class UserController extends Controller
{

     public function register( UserRegisterRequest $request ) {

        $request->validated();

        $user = User::create([

            "name" => $request["name"],
            "email" => $request["email"],
            "password" => bcrypt( $request["password"]),
            "admin" => $request["admin"]
        ]);

        return $this->sendResponse( $user->name, "Sikeres regisztráció");
    }

    public function login( UserLoginRequest $request ) {

        $request->validated();

        if( Auth::attempt([ "name" => $request["name"], "password" => $request["password"]])) {

            $actualTime = Carbon::now();
            $authUser = Auth::user();
            $bannedTime = ( new BannerController )->getBannedTime( $authUser->name );
            ( new BannerController )->reSetLoginCounter( $authUser->name );

            if( $bannedTime < $actualTime ) {

                (new BannerController)->setBannedTime( $authUser->name );

                $token = $authUser->createToken( $authUser->name."Token" )->plainTextToken;
                $data["user"] = [ "user" => $authUser->name ];
                $data[ "time" ] = $bannedTime;
                $data["token"] = $token;
                return $this->sendResponse($data,"Sikeres bejelentkezés");
            }
            else
            {
                return $this->sendError("Authentikációs hia",["Következő lehetőség: ".$bannedTime],401);
            }
        }else {

            $loginCounter = ( new BannerController )->getLoginCounter( $request[ "name" ]);
            if( $loginCounter < 3 ) {

                ( new BannerController )->setLoginCounter( $request[ "name" ]);

            }else {

                ( new BannerController )->setBannedTime( $request[ "name" ]);
            }
            $error = ( new BannerController )->getBannedTime( $request[ "name" ]);
            $errorMessage = [ "time" => Carbon::now(), "hiba" => "Nem megfelelő felhasználónév vagy jelszó" ];
            return $this->sendError( $error, [$errorMessage], 401 );
        }
    }

    public function logout() {

        auth( "sanctum" )->user()->currentAccessToken()->delete();
        $name = auth( "sanctum" )->user()->name;

        return $this->sendResponse( $name, "Sikeres kijelentkezés");
    }

}
