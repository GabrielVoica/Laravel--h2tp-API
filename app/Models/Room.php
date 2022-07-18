<?php

namespace App\Models;

use App\Models\Type;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    
    public function types(){
        return $this->belongsToMany(Type::class,'room_type');
    }


    public function messages(){
        return $this->hasMany(Message::class);
    }
 
}
