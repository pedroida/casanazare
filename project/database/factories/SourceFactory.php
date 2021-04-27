<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Source;
use Faker\Generator as Faker;

$factory->define(Source::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});
