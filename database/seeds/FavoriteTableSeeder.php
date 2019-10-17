<?php

use App\Models\Favorite;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class FavoriteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userIds = DB::table('users')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i <= 20; $i++) {
            factory(Favorite::class)->create([
                'user_id' => $faker->randomElement($userIds),
                'favoritable_id' => rand (1, 15),
                'favoritable_type' => $faker->randomElement(['Film', 'Comment'])
            ]);
        }
    }
}
