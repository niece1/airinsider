<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use App\Category;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->text(20),
        'body' => $faker->text(7000),
        'slug' => $faker->text(20),
        'published' => $faker->boolean(50),
        'viewed' => $faker->numberBetween(1, 1000),
        'time_to_read' => $faker->numberBetween(1, 10),
        'user_id' => function() {
            return User::all()->random();
        },
        'category_id' => function() {
            return Category::all()->random();
        },
    ];
});
