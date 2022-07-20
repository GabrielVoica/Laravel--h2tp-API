<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public function types(){
        return $this->belongsToMany(Type::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }
}
