<?php

use App\Models\Comment;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userIds = DB::table('users')->pluck('id')->toArray();
        $filmIds = DB::table('films')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i <= 20; $i++) {
            factory(Comment::class)->create([
                'user_id' => $faker->randomElement($userIds),
                'film_id' => $faker->randomElement($filmIds),
                "content" => $faker->realText($maxNbChars = 200, $indexSize = 2)
            ]);
        }
    }
}
