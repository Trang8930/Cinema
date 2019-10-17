<?php

use App\Models\Film;
use App\Models\User;
use App\Models\Comment;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UpdateCommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Comment::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $filmIDs = \DB::table('films')->pluck('id')->toArray();
        $userIDs = \DB::table('users')->pluck('id')->toArray();
        $faker = Faker::create();

        for ($i = 1; $i <= 50; $i++) {
            Comment::create([
                "film_id" => $faker->randomElement($filmIDs),
                "user_id" => $faker->randomElement($userIDs),
                "content" => $faker->realText($maxNbChars = 200, $indexSize = 2)
            ]);
            
        }
    }
}
