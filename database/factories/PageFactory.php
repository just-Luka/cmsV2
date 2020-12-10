<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Page;
use Faker\Generator as Faker;

$factory->define(Page::class, function (Faker $faker) {
    static $num = 1;

    return [
        'slug' => $faker->slug,
        'visible' => $faker->boolean,
        'sort' => $num ++,
        'page_type' => 'static',
        'template' => 'default',
    ];

});
