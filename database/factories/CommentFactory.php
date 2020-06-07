<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return User::all()->random();
        },
        'post_id' => function() {
            return Post::all()->random();
        },
        'body' => $faker->sentence(5),
        'comment_id' => null,
    ];
});
