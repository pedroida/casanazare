<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Stay;
use Faker\Generator as Faker;

$factory->define(Stay::class, function (Faker $faker) {
    return [
        'type' => \App\Enums\StayTypeEnum::COMPANION,
        'client_id' => factory(\App\Models\Client::class)->create()->id,
        'source_id' => factory(\App\Models\Source::class)->create()->id,
        'entry_date'=> now()->subDays(7)->format('d/m/Y'),
        'departure_date'=> now()->format('d/m/Y'),
        'comments'=> $faker->text(20)
    ];
});

$factory->state(Stay::class,'without_departure_date', [
    'departure_date'=> null,
]);