<?php

use Faker\Generator as Faker;

$factory->define(App\Hierarchy::class, function (Faker $faker) {
    return [
        'user_id' => $faker->unique()->numberBetween(1, 100),
        'goal'    => $faker->sentence(6, false)
    ];
});
