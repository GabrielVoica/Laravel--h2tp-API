<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

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
}
