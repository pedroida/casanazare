<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Donation;
use App\Models\Unit;
use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Donation::class, function (Faker $faker) {
    return [
        'name' => preg_replace('#[^A-Za-z0-9 ]+#', '', $faker->name),
        'quantity' => $faker->randomFloat(3, 0, 100),
        'validate' => $faker->date('Y-m-d', 'next week'),
        'donation_unit_id' => factory(Unit::class)->create()->id,
        'donation_category_id' => factory(Category::class)->create()->id,
    ];
});

$factory->state(Donation::class, 'empty', [
    'name' => '',
    'quantity' => null,
    'validate' => null,
    'donation_unit_id' => null,
    'donation_category_id' => null,
]);
