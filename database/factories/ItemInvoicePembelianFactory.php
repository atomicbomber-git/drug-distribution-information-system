<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ItemInvoicePembelian;
use Faker\Generator as Faker;

$factory->define(ItemInvoicePembelian::class, function (Faker $faker) {
    $obat = \App\Obat::inRandomOrder()->first();
    $jumlah_obat = rand(1, 20) * 100;

    return [
        "obat_id" => $obat->id,
        "nama_obat" => $obat->nama,
        "jumlah_obat" => $jumlah_obat,
        "harga_satuan_obat" => rand(1, 20) * 5000,
        "persentase_diskon_grosir" => rand(0, 3) / 100,
    ];
});
