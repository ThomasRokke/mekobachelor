<?php

use Faker\Generator as Faker;

$factory->define(App\Workshop::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'route' => $faker->name,
        'adr' => $faker->address,
        'lat' => $faker->latitude,
        'lng' => $faker->longitude,
        'place_id' => $faker->randomDigit,
        'phone' => $faker->phoneNumber,
        'prioritized' => $faker->boolean,
        'position' => $faker->randomDigit,



    ];
});
