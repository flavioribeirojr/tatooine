<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Security\Permission::class, function (Faker $faker) {
    return [
        'prm_method'      => $faker->unique()->domainWord,
        'prm_description' => $faker->text,
        'prm_rsc_id'      => function () {
            return factory(\App\Models\Security\Resource::class)->create()->rsc_id;
        }
    ];
});
