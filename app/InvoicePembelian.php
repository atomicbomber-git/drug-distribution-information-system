<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InvoicePembelian extends Model
{
    protected $table = "invoice_pembelian";
    protected $guarded = [];

    public function items(): HasMany
    {
        return $this->hasMany(
            ItemInvoicePembelian::class,
            "invoice_id",
        );
    }
}
