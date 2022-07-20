<?php

namespace App\Models;

use App\Models\Room\Room;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;



    public function rooms(){
        return $this->belongsToMany(Room::class,'room_type');
    }
}
