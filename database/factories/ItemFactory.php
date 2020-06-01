<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Item;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(Item::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'description' => $faker->sentences(3, true),
        'price' => $faker->randomFloat(2, 0, 10000),
        'available' => $faker->randomDigit(),
        'public' => $faker->boolean()
    ];
});
