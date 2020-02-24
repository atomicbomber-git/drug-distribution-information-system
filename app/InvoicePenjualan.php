<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InvoicePenjualan extends Model
{
    protected $table = "invoice_penjualan";
    protected $guarded = [];

    public function items(): HasMany
    {
        return $this->hasMany(
            ItemInvoicePenjualan::class,
            "invoice_id",
        );
    }
}
