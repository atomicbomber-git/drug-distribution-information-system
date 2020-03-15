<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs("batch");

            $table->unsignedInteger('obat_id')->index();
            $table->decimal("jumlah", 19, 4);
            $table->decimal("harga_satuan", 19, 4);
            $table->dateTime("tanggal_kadaluarsa");

            $table->timestamps();

            $table->foreign('obat_id')->references('id')->on('obat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock');
    }
}
