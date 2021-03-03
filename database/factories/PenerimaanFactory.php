<?php

namespace Database\Factories;

use App\Penerimaan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PenerimaanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Penerimaan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "nama_supplier" => $this->faker->company,
            "waktu_penerimaan" => now()->subMinutes(rand(0, 36_000)),
        ];
    }
}
