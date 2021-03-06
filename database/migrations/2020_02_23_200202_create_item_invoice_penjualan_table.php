<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemInvoicePenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_invoice_penjualan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('invoice_id')->index();
            $table->unsignedInteger('obat_id')->index();

            $table->string('nama_obat');
            $table->decimal('jumlah_obat', 19, 4);
            $table->decimal('harga_satuan_obat', 19, 4);
            $table->decimal('persentase_diskon_grosir', 19, 4);
            $table->timestamps();

            $table->foreign('obat_id')->references('id')->on('obat');
            $table->foreign('invoice_id')->references('id')->on('invoice_penjualan')
                ->onDelete("CASCADE");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_invoice_penjualan');
    }
}
