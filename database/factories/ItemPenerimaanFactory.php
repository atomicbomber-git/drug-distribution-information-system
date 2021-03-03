<?php

namespace Database\Factories;

use App\ItemPenerimaan;
use App\Obat;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemPenerimaanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ItemPenerimaan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "obat_id" => Obat::query()->select("id")->inRandomOrder()->value("id"),
            "jumlah" => rand(1, 25) * 10,
            "harga_satuan" => rand(1, 25) * 10_000,
            "tanggal_kadaluarsa" => now()->addMonths(rand(10, 20))->startOfMonth(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (ItemPenerimaan $itemPenerimaan) {
            $itemPenerimaan->stock()->create([
                "jumlah" => $itemPenerimaan->jumlah,
                "obat_id" => $itemPenerimaan->obat_id,
                "harga_satuan" => $itemPenerimaan->harga_satuan,
                "tanggal_kadaluarsa" => $itemPenerimaan->tanggal_kadaluarsa,
            ]);
        });
    }
}