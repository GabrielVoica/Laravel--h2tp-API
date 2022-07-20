<?php

use App\Http\Controllers\Room\RoomController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);

Route::group(['middleware' => ['auth:sanctum']], function(){

   //User related routes
   Route::get('profile',[UserController::class,'userProfile']);
   Route::get('logout',[UserController::class,'logout']);
   Route::get('user/rooms',[UserController::class,'getUserRooms']);

   //Rooms related routes
   Route::get('room/{id}',[RoomController::class,'getRoom']);
});

Route::middleware('auth:sanctum')->get('rooms',[RoomController::class,'getAll']);
