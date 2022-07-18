<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
class RoomController extends Controller
{
    public function create(Request $request){
        $room = new Room;
        $room->name = 'Test';
        $room->admin_id = User::find(1)->id;

        $room->save();

        $type = Type::find(1);

        $room->types()->attach($type);

        return 'Done';
    }

    public function getTypes(Request $request){

        $room = Room::find(1);
        $types = $room->types()->get();


        return $types;
    }


    public function getAll(){
        $rooms = Room::with('types')->get();



        return $rooms;
    }
}
