<?php

namespace Database\Seeders;

use Database\Factories\InvoicePenjualanFactory;
use Database\Factories\ItemInvoicePenjualanFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoicePenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        InvoicePenjualanFactory::new()
            ->count(100)
            ->has(
                ItemInvoicePenjualanFactory::new()
                , "items"
            )
            ->create();

        DB::commit();
    }
}
