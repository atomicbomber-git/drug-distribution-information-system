<?php

use App\ItemPenerimaan;
use App\Penerimaan;
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

        factory(Penerimaan::class, 100)
            ->create()
            ->each(function (Penerimaan $penerimaan) {
                factory(ItemPenerimaan::class, rand(1, 8))
                    ->create([
                        "tanggal_kadaluarsa" => $penerimaan->waktu_penerimaan->addMonths(rand(12, 36))->addDays(rand(0, 30))
                            ->setHour(0)
                            ->setMinute(0)
                            ->setSecond(0),
                        "penerimaan_id" => $penerimaan->id,
                    ])
                    ->each(function (ItemPenerimaan $item_penerimaan) {
                        $item_penerimaan->stock()->create([
                            "jumlah" => $item_penerimaan->jumlah,
                            "obat_id" => $item_penerimaan->obat_id,
                            "harga_satuan" => $item_penerimaan->harga_satuan,
                            "tanggal_kadaluarsa" => $item_penerimaan->tanggal_kadaluarsa,
                        ]);
                    });
            });

        DB::commit();
    }
}
