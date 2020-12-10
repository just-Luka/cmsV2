<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Banner;
use Faker\Generator as Faker;

$factory->define(Banner::class, function (Faker $faker) {
    static $num = 4;

    return [
        'url'     => $faker->url,
        'type'    => 'smallBanners',
        'visible' => 1,
        'sort'    => $num++
    ];
});
