<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->sentence($nbWords = 4, $variableNbWords = true),
        'description' => $faker->paragraph($nbSentences = 7, $variableNbSentences = true),
        'publication_year' => $faker->year($max = 'now'),
        'genre_id' => App\Genre::all()->random()->id,
        'author_id' => App\Author::all()->random()->id,
        'user_id' => App\User::all()->random()->id,
    ];
});
