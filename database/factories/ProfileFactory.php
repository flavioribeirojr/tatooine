<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Security\Profile::class, function (Faker $faker) {
    return [
        'prf_name'        => $faker->name,
        'prf_description' => $faker->sentence
    ];
});
