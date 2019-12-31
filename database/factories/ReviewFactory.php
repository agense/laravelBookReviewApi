<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Review;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'rating' => rand(1, 5),
        'review' => $faker->text($maxNbChars = 200),
        'book_id' => App\Book::all()->random()->id,
        'user_id' => App\User::where('role', 'user')->inRandomOrder()->first()->id,
    ];
});
