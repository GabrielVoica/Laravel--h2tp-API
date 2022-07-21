<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

      $user = User::where('email',$request->email)->first();

      //Checking if the user is registered
      if(!isset($user->id)){
          return response()->json([
              'status' => 0,
              'msg' => 'User data not found',
          ],404);
      }

      //Checking if the password is correct
      if(!Hash::check($request->password,$user->password)){
          return response()->json([
              'status' => 0,
              'msg' => 'Incorrect password'
          ]);
      }

      $token = $user->createToken("auth_token");
      $user->connected = true;
      $user->save();

      return response()->json([
          'status' => 1,
          'msg' => 'Successful login',
          "access_token" => $token->plainTextToken
      ],200);
    }


    public function userProfile(){
        return response()->json([
            'status' => 1,
            'msg' => 'User profile data',
            "data" => Auth::user()
        ],200);
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        auth()->user()->connected = 0;
        auth()->user()->save();

        return response()->json([
            'status' => 1,
            'msg' => 'Session ended',
        ],200);
    }


    public function getUserRooms(Request $request){
        $user = Auth::user();

        $rooms = $user->rooms()->get();

        return response()->json([
            'status' => 1,
            'msg' => 'User rooms',
            'data' => $rooms
        ]);
    }
}
