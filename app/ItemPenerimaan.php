<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Log;

/**
 * @property double jumlah
 * @property Stock stock
 */
class ItemPenerimaan extends Model
{
    protected $table = "item_penerimaan";
    protected $guarded = [];

    public function stock(): MorphOne
    {
        return $this->morphOne(Stock::class, "batch");
    }
}
