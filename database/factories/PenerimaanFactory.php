<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Penerimaan;
use Faker\Generator as Faker;

$factory->define(Penerimaan::class, function (Faker $faker) {
    return [
        "nama_supplier" => $faker->company,
        "waktu_penerimaan" => now()->subMinutes(rand(0, 36_000)),
    ];
});
