<?php

use Faker\Generator as Faker;

$factory->define(App\Page::class, function (Faker $faker, $params) {
    return [
        'action_id'    => $params['action_id'],
        'description'  => $faker->sentence(6, false),
        'fear_before'  => $faker->numberBetween(7, 9),
        'fear_during'  => $faker->numberBetween(4, 7),
        'satisfaction' => $faker->numberBetween(1, 10)
    ];
});
