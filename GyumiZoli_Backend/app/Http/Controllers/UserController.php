<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

     // Megjeleníti az összes felhasználót
     public function getUser()
     {
         $users = User::all();
         return response()->json($users);
     }
 
     // Létrehozza az új felhasználót
     public function addUser(UserRequest $request)
     {
         $user = User::create($request->validated());
         return response()->json($user, 201); 
     }
 
     // Megjeleníti a megadott felhasználót
     public function showUser(User $user)
     {
         return response()->json($user);
     }
 
     // Frissíti a megadott felhasználót
     public function updateUser(UserRequest $request, User $user)
     {
         $user->update($request->validated());
         return response()->json($user);
     }
 
     // Törli a megadott felhasználót
     public function destroyUser(User $user)
     {
         $user->delete();
         return response()->json(null, 204); 
     }


}
