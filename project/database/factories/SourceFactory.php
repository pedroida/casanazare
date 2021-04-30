<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Source;
use Faker\Generator as Faker;

$factory->define(Source::class, function (Faker $faker) {
    return [
        'name' => preg_replace('#[^A-Za-z0-9 ]+#', '', $faker->name)
    ];
});
