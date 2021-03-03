<?php

namespace Database\Factories;

use App\ItemInvoicePenjualan;
use App\Obat;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemInvoicePenjualanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ItemInvoicePenjualan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $obat = Obat::query()->inRandomOrder()->first();
        $jumlah_obat = rand(1, 20) * 100;

        return [
            "obat_id" => $obat->id,
            "nama_obat" => $obat->nama,
            "jumlah_obat" => $jumlah_obat,
            "harga_satuan_obat" => rand(1, 20) * 5000,
            "persentase_diskon_grosir" => rand(0, 3) / 100,
        ];
    }
}