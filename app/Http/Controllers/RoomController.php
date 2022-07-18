<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
class RoomController extends Controller
{
    

    public function getAll(){
        $rooms = Room::with('types')->get();


        return $rooms;
    }
}
