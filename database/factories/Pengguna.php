<?php

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Pengguna::class, function (Faker $faker) {
    return [
        'usaha' => "U2042ZIAY0",
        'nama' => $faker->name($gender = 'female'),
        'email' => strtolower("admin@yuni.org"),
        'password' => 'poiuytrewq',
    ];
});
