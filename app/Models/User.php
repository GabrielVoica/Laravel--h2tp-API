<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Block;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function messages(){
        return $this->hasMany(Message::class,'sender_id');
    }

    public function rooms(){
        return $this->belongsToMany(Room::class);
    }

    public function createdRooms(){
        return $this->hasMany(Room::class);
    }

    public function blocks(){
        return $this->hasMany(Block::class);
    }
}
