<?php

use Faker\Generator as Faker;
use App\Http\Helpers\ArrayHelper;

$arrayHelper = new ArrayHelper([1,2,3,4,5,6,7,8,9,10]);

$factory->define(App\Action::class, function (Faker $faker) use($arrayHelper) {
    return [
        'hierarchy_id' => $faker->numberBetween(1, 50),
        'level' => $arrayHelper->getRandomElement(),
        'description' => $faker->sentence(5, false),
        'fear_average' => $faker->randomFloat(2, 2, 8)
    ];
});
