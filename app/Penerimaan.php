<?php

namespace App;

use App\Casts\DateCast;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property Collection|ItemPenerimaan[] item_penerimaans
 * @property Carbon waktu_penerimaan
 */
class Penerimaan extends Model
{
    protected $table = "penerimaan";
    public $guarded = [];

    public $dates = [
        "waktu_penerimaan",
    ];

    public function item_penerimaans(): HasMany
    {
        return $this->hasMany(ItemPenerimaan::class);
    }
}
