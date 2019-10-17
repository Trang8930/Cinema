<?php

use App\Models\City;
use App\Models\Cinema;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CinemaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cityIds = [9, 15, 24, 25, 55, 56];
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            $cityID = $faker->randomElement($cityIds);
            $cityName =City::where("id", $cityID)->get();
            $cityName = $cityName->toArray()[0]["name"];
            factory(Cinema::class)->create([
                'city_id' => $cityID,
                "name" => "Best Film Cinema " . $cityName . " " . $i
            ]);
        }
    }
}
