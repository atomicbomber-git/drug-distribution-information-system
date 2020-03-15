<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    const TABLE_NAME = "stock";

    protected $table = self::TABLE_NAME;
    protected $guarded = [];
}
