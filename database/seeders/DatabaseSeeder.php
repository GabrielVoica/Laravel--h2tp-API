<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       //Seeding rooms, users and messages, maintaining all relationships coherent
       User::factory(10)->create()->each(function($user){
           $room = Room::factory(1)->create()->each(function($room){
               $message = Message::factory(4)->create();
               $room->messages()->saveMany($message);
               $user = User::all()->random(1)->first();
               $user->messages()->saveMany($message);
           });

           $user->createdRooms()->saveMany($room);
           $user->rooms()->attach($room);
        });
    }
}
