<?php
use Carbon\Carbon;

$factory('App\User', [
    'name' => $faker->word,
    'email' => $faker->email,
    'password' => $faker->text($maxNbChars = 200)
]);

$factory('App\Lunch', [
    'starts_at' => Carbon::now(),
    'duration_in_minutes' => 60
]);