<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'product' => $faker->randomElement(['T-shirt',
                                            'Sweater',
                                            'Jacket',
                                            'Coat',
                                            'Trousers',
                                            'Shorts',
                                            'Vest',
                                            'Boots',
                                            'Skirt',
                                            'Dress',
                                            'Blouse']),
        'description' => $faker->text,
    ];
});
