<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $citiesID = DB::table('cities')->pluck('id')->toArray();
        for($i = 1; $i <= 20; $i++) {
            factory(User::class, 1)->create([
                "city_id" => $citiesID[$i]
            ]);
        }
    }
}
