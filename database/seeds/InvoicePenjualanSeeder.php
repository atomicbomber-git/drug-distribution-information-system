<?php

use App\InvoicePenjualan;
use App\ItemInvoicePenjualan;
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

        factory(InvoicePenjualan::class, 100)
            ->create()
            ->each(function (InvoicePenjualan $invoice_penjualan) {
                factory(ItemInvoicePenjualan::class, 10)
                    ->create([
                        "invoice_id" => $invoice_penjualan->id
                    ]);
            });

        DB::commit();
    }
}
