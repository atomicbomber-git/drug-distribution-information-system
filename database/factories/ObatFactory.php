<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Obat;
use Faker\Generator as Faker;

$factory->define(Obat::class, function (Faker $faker) {
    return [
        "nama" => $faker->unique->medicine,
        "deskripsi" => $faker->realText(50),
    ];
});
