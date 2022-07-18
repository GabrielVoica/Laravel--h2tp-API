<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request){
      $request->validate([
        'username' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed'
      ]);

      $user = new User();
      $user->username = $request->username;
      $user->email = $request->email;
      $user->password = Hash::make($request->password);
      $user->save();

      return response()->json([
        "status" => 1,
        "msg" => "User registered"
      ]);

    }

    public function login(Request $request){
      $request->validate([
        "email" => "required|email",
        "password" => "required"
      ]);

     $user =  User::where("email", "=", $request->email)->first();

     if(isset($user->id)){
        if(Hash::check($request->password,$user->password)){
          $token = $user->createToken("auth_token")->plainTextToken;

          return response()->json([
            'status' => 1,
            'msg' => 'Successful login',
            "access_token" => $token
           ],200);

        }
        else{
            return response()->json([
                'status' => 0,
                'msg' => 'Incorrect password'
            ],404);
        }
     }
     else{
        return response()->json([
            'status' => 0,
            'msg' => 'User not registered'
        ],404);
     }
    }

    public function userProfile(){
        return response()->json([
            'status' => 1,
            'msg' => 'User profile data',
            "data" => auth()->user()
        ],200);
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => 1,
            'msg' => 'Session ended',
        ],200);
    }
}
