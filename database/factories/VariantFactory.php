<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Variant;
use Faker\Generator as Faker;

$factory->define(Variant::class, function (Faker $faker) {
    return [
        'size' => $faker->randomElement(['S', 'M', 'L', 'XL', 'XXL']),
        'color' => $faker->colorName,
        'material' => $faker->randomElement(['Cotton', 'Wool', 'Denim', 'Leather']),
        'price' => $faker->numberBetween($min = 50, $max = 1000),
        'quantity' => $faker->numberBetween($min = 1, $max = 100),
    ];
});
