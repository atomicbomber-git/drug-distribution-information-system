<?php

use App\InvoicePembelian;
use App\ItemInvoicePembelian;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoicePembelianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        factory(InvoicePembelian::class, 100)
            ->create()
            ->each(function (InvoicePembelian $invoice_pembelian) {
                factory(ItemInvoicePembelian::class, 10)
                    ->create([
                        "invoice_id" => $invoice_pembelian->id
                    ]);
            });

        DB::commit();
    }
}
