<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

//User
$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'username' => $faker->name,
        'fullname' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('123456'), // secret
        'birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'access_token' => str_random(100),
        'is_active' => rand(0,1),
        'role' => rand(0,1),
        'remember_token' => str_random(10),
    ];
});



//City
$factory->define(App\Models\City::class, function (Faker $faker) {
    return [];
});

//Cinema
$factory->define(App\Models\Cinema::class, function (Faker $faker) {
    return [];
});

//Room
$factory->define(App\Models\Room::class, function (Faker $faker) {
    return [];
});

//Seat
$factory->define(App\Models\Seat::class, function (Faker $faker) {
    return [];
});

$factory->define(App\Models\Schedule::class, function (Faker $faker) {
    return [];
});

$factory->define(App\Models\Comment::class, function (Faker $faker) {
    return [];
});
