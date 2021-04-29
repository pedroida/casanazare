<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Enums\UserRolesEnum;
use App\Models\User;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => preg_replace('#[^A-Za-z0-9 ]+#', '', $faker->name),
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->state(User::class, 'empty', [
    'name' => null,
    'email' => null,
    'password' => null,
]);

$factory->afterCreatingState(User::class, 'admin', function ($user, $faker) {
    $user->assignRole(UserRolesEnum::ADMIN);
});

$factory->afterCreatingState(User::class, 'voluntary', function ($user, $faker) {
    $user->assignRole(UserRolesEnum::VOLUNTARY);
});
