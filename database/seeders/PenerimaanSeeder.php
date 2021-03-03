<?php

namespace Database\Seeders;

use App\ItemPenerimaan;
use App\Penerimaan;
use Database\Factories\ItemPenerimaanFactory;
use Database\Factories\PenerimaanFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenerimaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        PenerimaanFactory::new()
            ->count(100)
            ->has(
                ItemPenerimaanFactory::new()
                    ->state(function (array $attributes, Penerimaan $penerimaan) {
                        return [
                            "tanggal_kadaluarsa" => $penerimaan->waktu_penerimaan
                                ->addMonths(rand(12, 36))
                                ->addDays(rand(0, 30))
                                ->setHour(0)
                                ->setMinute(0)
                                ->setSecond(0),
                        ];
                    })
                    ->count(
                        rand(1, 8)
                    )
            , "item_penerimaans")
            ->create();

        DB::commit();
    }
}
