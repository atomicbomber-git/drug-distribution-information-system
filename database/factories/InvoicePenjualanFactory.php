<?php

namespace Database\Factories;

use App\InvoicePenjualan;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoicePenjualanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InvoicePenjualan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "nama_customer" => $this->faker->company,
            "waktu_penjualan" => now()->subMinutes(rand(0, 36_000)),
            "persentase_diskon_cash" => rand(1, 15) / 100,
            "persentase_pajak" => 10 / 100,
        ];
    }
}