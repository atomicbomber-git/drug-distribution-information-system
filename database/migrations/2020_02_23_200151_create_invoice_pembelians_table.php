<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicePembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_pembelian', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_perusahaan');
            $table->dateTime('waktu_penerimaan');
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
        Schema::dropIfExists('invoice_pembelians');
    }
}
