<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(\App\Usaha::class, function (Faker $faker) {
	$faker = \Faker\Factory::create('id_ID');
	$sum_date = (date('Y') + date('m')) + date('d');
	$usaha = $faker->unique()->firstNameFemale;
    return [
        'kode' => "U" . $sum_date . strtoupper(Str::random(5)),
        'nama' => $usaha,
        'alamat' => $faker->address,
        'email' => 'info@' . strtolower($usaha) . '.org',
        'telp' => $faker->phoneNumber,
    ];
});
