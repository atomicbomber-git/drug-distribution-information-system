<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @property double jumlah
 * @property Collection|Stock[] stocks
 * @property int obat_id
 * @property double harga_satuan
 * @property string tanggal_kadaluarsa
 */
class ItemPenerimaan extends Model
{
    protected $table = "item_penerimaan";
    protected $guarded = [];

    public function penerimaan(): BelongsTo
    {
        return $this->belongsTo(Penerimaan::class);
    }

    public function stock(): MorphOne
    {
        return $this->morphOne(Stock::class, "batch");
    }
}
