<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Security\ResourceCategory::class, function (Faker $faker) {
    return [
        'rct_slug' => $faker->unique()->name,
        'rct_name' => $faker->name
    ];
});
