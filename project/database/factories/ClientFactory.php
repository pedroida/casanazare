<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'rg' => $faker->randomNumber(9),
        'date_of_birth' => $faker->date('d/m/Y', now()->subYears(18)->year),
        'phone_one' => $faker->numerify('##################'),
        'phone_two' => $faker->numerify('##################'),
        'city_id' => \App\Models\City::first()->id,
        'forbidden' => false,
    ];
});

$factory->state(Client::class, 'forbidden', [
    'forbidden' => true,
]);

$factory->state(Client::class, 'empty', [
    'name' => '',
    'rg' => '',
    'date_of_birth' => null,
    'phone_one' => null,
    'phone_two' => null,
    'city_id' => null,
    'forbidden' => null,
]);
