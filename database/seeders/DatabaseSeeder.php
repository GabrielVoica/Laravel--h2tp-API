<?php

namespace Database\Seeders;

use App\Models\Room\Room;
use App\Models\User\User;
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
       User::factory(5)->create()->each(function($user){
           $room = Room::factory(1)->create();
           $user->createdRooms()->saveMany($room);
           $user->rooms()->attach($room);
        });
    }
}
