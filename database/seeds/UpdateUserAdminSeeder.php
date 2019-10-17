<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UpdateUserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            User::where("id", 1)->update([
                "username" => "admin",
                "email" => "an.lc.vn@gmail.com",
                "fullname" => "An Nguyen Q.",
                "birthday" => "1995-12-30",
                "role" => 1,
                "is_active" => 1,
                "city_id" => 15
            ]);
            User::orderBy("id", "DESC")->limit(1)->update([
                "username" => "annguy",
                "email" => "an@yopmail.com",
                "fullname" => "An Nguyen",
                "birthday" => "1995-11-09",
                "role" => 1,
                "is_active" => 1,
                "city_id" => 15
            ]);
    }
}
