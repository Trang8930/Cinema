<?php

use App\Models\Room;
use App\Models\Seat;
use Illuminate\Database\Seeder;

class UpdateSeatsAvailableRoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 50; $i++) {
            $count = Seat::where("room_id", $i)->where("status", 1)->count();
            $room = Room::findOrFail($i)->update([
                "seats_available" => $count
            ]);
        }
    }
}
