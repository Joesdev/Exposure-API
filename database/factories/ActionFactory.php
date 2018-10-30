<?php

use Faker\Generator as Faker;

$factory->define(App\Action::class, function (Faker $faker, $params) {
    return [
        'hierarchy_id' => $params['hierarchy_id'],
        'level' => $params['level'],
        'description' => $faker->sentence(5, false),
        'fear_average' => $faker->randomFloat(2, 2, 8)
    ];
});
