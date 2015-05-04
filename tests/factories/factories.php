<?php
use Laracasts\TestDummy\Factory;
use Carbon\Carbon;

$factory('App\User', [
    'name' => $faker->sentence(5),
    'email' => $faker->email,
    'password' => $faker->text($maxNbChars = 200)
]);

$factory('App\Lunch', [
    'starts_at' => Carbon::now()->next(),
    'duration_in_minutes' => $faker->numberBetween(1, 255), #unsigned tinyint
	'circle_id' => 'factory:App\Circle'
]);

$factory('App\Circle', [
    'name' => $faker->text(254),
    'description' => $faker->text(511)
]);
