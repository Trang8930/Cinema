<?php

use App\Models\Room;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class RoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cinemaIds = DB::table('cinemas')->pluck('id')->toArray();
        $j = 0;
        for ($i = 0; $i < 10; $i++) {
            for ($h = 0; $h < 5; $h++) {
                factory(Room::class)->create([
                    'cinema_id' => $cinemaIds[$i],
                    "name" => "Room " . ($h + 1)
                ]);
            }
        }
    }
}
