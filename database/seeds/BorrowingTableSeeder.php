<?php

use App\Models\Borrowing;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class BorrowingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userIds = DB::table('users')->pluck('id')->toArray();
        $scheduleIds = DB::table('schedules')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i <= 20; $i++) {
            factory(Borrowing::class)->create([
                'user_id' => $faker->randomElement($userIds),
                'schedule_id' => $faker->randomElement($scheduleIds),
            ]);
        }
    }
}
