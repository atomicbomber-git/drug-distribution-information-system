<?php

/** @var Factory $factory */

use App\ItemPenerimaan;
use App\Obat;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(ItemPenerimaan::class, function (Faker $faker) {
    return [
        "obat_id" => Obat::query()->select("id")->inRandomOrder()->value("id"),
        "jumlah" => rand(1, 25) * 10,
        "harga_satuan" => rand(1, 25) * 10_000,
        "tanggal_kadaluarsa" => now()->addMonths(rand(10, 20))->startOfMonth(),
    ];
});

$factory->afterCreating(ItemPenerimaan::class, function (ItemPenerimaan $item_penerimaan) {
    $item_penerimaan->stock()->create([
        "jumlah" => $item_penerimaan->jumlah,
    ]);
});
