<?php

namespace App\Models;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Message extends Model
{
    use HasFactory;



    public function room(){
        return $this->belongsTo(Room::class,'room_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'sender_id');
    }
}
