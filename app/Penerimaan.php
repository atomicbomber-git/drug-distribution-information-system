<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property Collection|ItemPenerimaan[] item_penerimaans
 */
class Penerimaan extends Model
{
    protected $table = "penerimaan";
    public $guarded = [];

    public function item_penerimaans(): HasMany
    {
        return $this->hasMany(ItemPenerimaan::class);
    }
}
