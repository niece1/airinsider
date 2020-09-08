<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Like;
use App\User;
use Faker\Generator as Faker;

$factory->define(Like::class, function (Faker $faker) {
    return [
        'type' => $faker->randomElement(['up', 'down']),
        'likeable_type' => 'App\Post',
        'likeable_id' => 1,
        'user_id' => function () {
            return User::all()->random();
        },
    ];
});
