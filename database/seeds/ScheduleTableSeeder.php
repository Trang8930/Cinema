<?php

use App\Models\Film;
use App\Models\Room;
use App\Models\Cinema;
use App\Models\Schedule;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ScheduleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schedule::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $time_start = ['8:30', '10:45', '15:00', '17:15', '19:30'];
        $time_finish = ['10:30', '12:45', '17:00', '19:15', '21:30'];

        $cityIds = [9, 15, 24, 25, 55, 56];        
        $filmIds = Film::select("id")->whereBetween('id', [1, 11])->get();
        
        $cinemaIds = Cinema::select("id")->whereIn("city_id", $cityIds)->get();
        foreach ($cinemaIds as $cinemaId) {
            $roomIds = Room::select("id")->where("cinema_id", $cinemaId->id)->get();
            foreach ($filmIds as $filmId) {
                $i = 0;
                foreach ($roomIds as $roomId) {
                    factory(Schedule::class)->create([
                        'room_id' => $roomId->id,
                        'film_id' => $filmId->id,
                        'time_start' => $time_start[$i],
                        'date' => date("Y-m-d"),
                        'time_finish' => $time_finish[$i],
                    ]);
                    $i++;
                } 
            }            
        }
    }
}
