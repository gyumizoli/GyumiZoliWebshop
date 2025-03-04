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

        $user = User::create([
            "name" => $request["name"],
            "email" => $request["email"],
            "password" => bcrypt($request["password"]),
            "phone" => $request["phone"],
            "address" => $request["address"],
            "birth_date" => $request["birth_date"],
            "admin" => $request["admin"],
            "profile_picture" => $request->file('profile_picture')->store('profile_pictures', 'public')
        ]);

        return response()->json($user);
    }
    public function updateUserAdmin(Request $request)
    {
        // if (!Gate::allows("super")) {
        //     return $this->sendError("Authentikációs hiba!","Nincs jogosultság",401);
        // }

        $user = User::findOrFail($request->input('id'));
        $oldImage = $user->profile_picture;

        if ($request->has('delete_image') && $request->input('delete_image') == true) {
            if ($oldImage) {
                $imagePath = str_replace(url('/storage/'), '', $oldImage);
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
            $user->profile_picture = null;
        }

        if ($request->hasFile('profile_picture')) {
            if ($oldImage) {
                $imagePath = str_replace(url('/storage/'), '', $oldImage);
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
            $user->profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->birth_date = $request->input('birth_date');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        $user->admin = $request->input('admin');

        $user->update();
        return response()->json("Sikeres frissítés!");
    }
    
}
