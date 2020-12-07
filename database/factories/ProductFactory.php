<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'brand' => $faker->randomElement(['Nike', 'Adidas', 'Converses', 'Puma']),
        'name' => $faker->word,
        'price' => $faker->numberBetween($min = 10, $max = 99) * 10000,
        'quantity' => $faker->numberBetween($min = 1, $max = 255),
        'description' => $faker->paragraph($nbSentences = 2, $variableNbSentences = true),
        'image' => $faker->imageUrl($width = 640, $height = 480, 'sports'),
    ];
});
