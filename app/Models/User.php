<?php

namespace App\Models;

use App\Models\Room;
use App\Models\Message;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;



    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function rooms(){
        return $this->belongsToMany(Room::class);
    }

    public function createdRooms(){
        return $this->hasMany(Room::class);
    }
}
