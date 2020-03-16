<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\InvoicePenjualan;
use Faker\Generator as Faker;

$factory->define(InvoicePenjualan::class, function (Faker $faker) {
    return [
        "nama_customer" => $faker->company,
        "waktu_penjualan" => now()->subMinutes(rand(0, 36_000)),
        "persentase_diskon_cash" => rand(1, 15) / 100,
        "persentase_pajak" => 10 / 100,
    ];
});
