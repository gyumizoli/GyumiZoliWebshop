<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{

     // Megjeleníti az összes felhasználót
     public function getUser()
     {
         $users = User::all();
         return response()->json($users);
     }
 
     // Létrehozza az új felhasználót
     public function store(UserRequest $request)
     {
         $user = User::create($request->validated());
         return response()->json($user, 201); 
     }
 
     // Megjeleníti a megadott felhasználót
     public function show(User $user)
     {
         return response()->json($user);
     }
 
     // Frissíti a megadott felhasználót
     public function update(UserRequest $request, User $user)
     {
         $user->update($request->validated());
         return response()->json($user);
     }
 
     // Törli a megadott felhasználót
     public function destroy(User $user)
     {
         $user->delete();
         return response()->json(null, 204); 
     }


}
