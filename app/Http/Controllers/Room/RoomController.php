<?php

namespace App\Http\Controllers\Room;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{

    public function getAll(){
        $rooms = Room::with('types')->get();
        return $rooms;
    }

    public function getRoom(Request $request,$id){

        $room = Room::find($id);

        if(isset($room)){
            return response()->json([
                'status' => 1,
                'msg' => 'Room data returned',
                'data' => $room
            ]);
        }
        else{
            return response()->json([
                'status' => 0,
                'msg' => 'Room not found',
            ],404);
        }
    }


    public function createRoom(Request $request){

        //TODO Add validation constraints
        $request->validate([
            'name' => 'required',
            'admin_id' => 'required|exists:users,id',
            'private' => 'required'
        ]);

        $roomName = $request->query('name');
        $roomAdminId = intval($request->query('admin_id'));
        $isPrivate = $request->query('private');

        $room = new Room();
        $room->name = $roomName;
        $room->user_id = intval($request->query('admin_id'));
        $room->private = $isPrivate == '1' ? true : false;
        $room->save();

        $user = User::find($roomAdminId);
        $user->rooms()->attach($room);


        return response()->json([
            'status' => 1,
            'msg' => 'Room create succesfully',
            'data' => $room
        ],200);
    }

    public function deleteRoom(Request $request,$id){

       $room = Room::find($id);

       //TODO Make this a condition
       if(!isset($room)){
           return response()->json([
               'status' => 1,
               'msg' => 'The room with the provided id does not exist'
           ],404);
       }
    }


    public function enterRoom(Request $request,$id){
      if(!isset(Room::find($id)->id)){
        return response()->json([
            'status' => 0,
            'msg' => 'The room with the probided id does not exist',
        ],404);
      }

      $user = Auth::user();
      $room = Room::find($id);

      if($user->rooms->contains($room)){
        return response()->json([
            'status' => 0,
            'msg' => 'User already inside the room'
        ],400);
      }

      $user->rooms()->attach($room);

      return response()->json([
        'status' => 1,
        'msg' => 'User added to the room'
      ],200);
    }


    //TODO Implement function
    public function exitRoom(Request $request,$id){

    }
}
