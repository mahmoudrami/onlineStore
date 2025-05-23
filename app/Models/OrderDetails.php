<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetails extends Model
{
    //
    use SoftDeletes;

    protected $guarded = [];

    protected static function booted(): void
    {
        static::created(function (Product $product) {
            $product->quantity = $product->quantity - 1;
        });
    }
}
