<?php

use Faker\Generator as Faker;

$factory->define(App\Action::class, function (Faker $faker) {
    return [
        'hierarchy_id' => $faker->numberBetween(1, 50),
        'level' => $faker->unique()->numberBetween(1,10),
        'description' => $faker->sentence(5, false),
        'fear_average' => $faker->randomFloat(2, 2, 8)
    ];
});
