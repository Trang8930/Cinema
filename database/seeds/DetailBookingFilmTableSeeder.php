<?php

use Faker\Factory as Faker;
use App\Models\DetailBorrowing;
use Illuminate\Database\Seeder;

class DetailBookingFilmTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $borrowingIds = DB::table('borrowings')->pluck('id')->toArray();
        $seatIds = DB::table('seats')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i <= 20; $i++) {
            factory(DetailBorrowing::class)->create([
                'borrowing_id' => $faker->randomElement($borrowingIds),
                'seat_id' => $faker->randomElement($seatIds),
            ]);
        }
    }
}
