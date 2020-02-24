<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\InvoicePembelian;
use Faker\Generator as Faker;

$factory->define(InvoicePembelian::class, function (Faker $faker) {
    return [
        "nama_perusahaan" => $faker->company,
        "waktu_penerimaan" => now()->subMinutes(rand(0, 36_000)),
        "persentase_diskon_cash" => rand(1, 15) / 100,
        "persentase_pajak" => 10 / 100,
    ];
});
