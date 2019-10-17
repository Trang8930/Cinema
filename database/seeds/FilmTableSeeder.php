<?php

use App\Models\Film;
use App\Models\Comment;
use App\Models\Schedule;
use Illuminate\Database\Seeder;

class FilmTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Film::truncate();
        Schedule::truncate();
        Comment::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
