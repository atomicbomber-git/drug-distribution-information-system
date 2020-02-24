<?php

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

        factory(\App\Penerimaan::class, 100)
            ->create()
            ->each(function (\App\Penerimaan $penerimaan) {
                factory(\App\ItemPenerimaan::class)
                    ->create([
                        "penerimaan_id" => $penerimaan->id,
                    ]);
            });

        DB::commit();
    }
}
