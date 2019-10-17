<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CityTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CinemaTableSeeder::class);
        $this->call(RoomTableSeeder::class);
        $this->call(SeatTableSeeder::class);
        $this->call(UpdateSeatsAvailableRoomTableSeeder::class);
        $this->call(UpdateUserAdminSeeder::class);
    }
}
