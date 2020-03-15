<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Obat extends Model
{
    const TABLE_NAME = "obat";

    protected $table = self::TABLE_NAME;
    protected $guarded = [];

    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }
}
