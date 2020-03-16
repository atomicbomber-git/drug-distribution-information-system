<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicePenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_penjualan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_customer');
            $table->dateTime('waktu_penjualan');
            $table->decimal('persentase_diskon_cash', 19, 4);
            $table->decimal('persentase_pajak', 19, 4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_penjualan');
    }
}
