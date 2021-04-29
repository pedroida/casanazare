<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'name' => preg_replace('#[^A-Za-z0-9 ]+#', '', $faker->name),
        'rg' => $faker->numerify('############'),
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
