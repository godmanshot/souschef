<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Core\Menu\Week;
use Faker\Generator as Faker;

$factory->define(Week::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'start_at' => now()->startOfWeek(),
        'end_at' => now()->endOfWeek(),
    ];
});
