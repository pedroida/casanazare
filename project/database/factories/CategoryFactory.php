<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => preg_replace('#[^A-Za-z0-9 ]+#', '', $faker->name)
    ];
});
