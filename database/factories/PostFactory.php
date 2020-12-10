<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use \Illuminate\Support\Facades\Auth;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    static $num = 1;

    return [
        'slug' => $faker->slug,
        'visible' => $faker->boolean,
        'sort' => $num ++,
        'template' => 'default',
        'user_id' => Auth::user(),
    ];
});
