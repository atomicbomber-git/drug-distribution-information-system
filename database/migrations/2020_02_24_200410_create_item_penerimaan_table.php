<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemPenerimaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_penerimaan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('penerimaan_id')->index();
            $table->unsignedInteger('obat_id')->index();
            $table->decimal("jumlah", 19, 4);
            $table->decimal("harga_satuan", 19, 4);
            $table->timestamps();

            $table->foreign('obat_id')->references('id')->on('obat');
            $table->foreign('penerimaan_id')->references('id')->on('penerimaan')
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
        Schema::dropIfExists('item_penerimaan');
    }
}
