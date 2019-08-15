<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(\App\Barang::class, function (Faker $faker) {
	$faker = \Faker\Factory::create('en_US');
	$faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));
	$harga = $faker->unique()->randomNumber($nbDigits = 5, $strict = FALSE);
    $sum_date = (date('Y') + date('m')) + date('d');
    return [
        'kode' => "B" . $sum_date . strtoupper(Str::random(5)),
        'usaha' => "U2042ZIAY0",
        'nama' => $faker->fruitName() . " " . $faker->city,
        'stok' => $faker->unique()->randomDigitNotNull,
        'harga_jual' => $harga + 1000,
        'harga_beli' => $harga
    ];
});
