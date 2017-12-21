<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Security\Resource::class, function (Faker $faker) {
    return [
        'rsc_name'        => $faker->unique()->name,
        'rsc_description' => $faker->text,
        'rsc_rct_id'      => function () {
            return factory(\App\Models\Security\ResourceCategory::class)->create()->rct_id;
        }
    ];
});
