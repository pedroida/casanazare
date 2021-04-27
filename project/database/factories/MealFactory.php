<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Meal;
use Faker\Generator as Faker;

$factory->define(Meal::class, function (Faker $faker) {
    return [
        'day' => $faker->date('d/m/Y'),
        'breakfasts' => $faker->numberBetween(1, 50),
        'lunches' => $faker->numberBetween(1, 50),
        'dinners' => $faker->numberBetween(1, 50),
    ];
});

$factory->state(Meal::class, 'empty', [
    'day' => null,
    'breakfasts' => null,
    'lunches' => null,
    'dinners' => null,
]);
