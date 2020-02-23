<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\InvoicePembelian;
use Faker\Generator as Faker;

$factory->define(InvoicePembelian::class, function (Faker $faker) {
    return [
        "nama_perusahaan" => $faker->company,
        "tanggal_penerimaan" => now()->subDays(rand(0, 100)),
        "persentase_diskon_cash" => 10 / 100,
        "persentase_pajak" => 10 / 100,
    ];
});
