<?php

use App\Http\Controllers\Room\RoomController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Non auth needed routes
Route::post('register',[UserController::class,'register'])->name('register');
Route::post('login',[UserController::class,'login'])->name('login');


Route::group(['middleware' => ['auth:sanctum']], function(){
   //User related routes
   Route::get('profile',[UserController::class,'userProfile'])->name('profile');
   Route::get('logout',[UserController::class,'logout'])->name('logout');

   Route::post('profile/edit',[UserController::class,'editProfile'])->name('editProfile');


   //Rooms related routes
   Route::get('room/{id}',[RoomController::class,'getRoom']);
   Route::get('user/rooms',[UserController::class,'getUserRooms'])->name('getUserRooms');  //Get the current logged user rooms
   Route::get('room/messages/{id}',[RoomController::class,'getRoomMessages'])->name('getRoomMessages');

   Route::post('room/create',[RoomController::class,'createRoom'])->name('createRoom');
   Route::post('room/delete/{id}',[RoomController::class,'deleteRoom'])->name('deleteRoom');
   Route::post('room/join/{id}',[RoomController::class,'joinRoom'])
   ->middleware('banned');

   Route::post('room/exit/{id}',[RoomController::class,'exitRoom']);
   Route::post('room/user/ban/{id}',[RoomController::class,'banUser']);
});
