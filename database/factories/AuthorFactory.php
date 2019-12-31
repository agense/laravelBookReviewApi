<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Author;
use Faker\Generator as Faker;

$factory->define(Author::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'user_id' => App\User::where('role', 'admin')->first()->id,
    ];
});
