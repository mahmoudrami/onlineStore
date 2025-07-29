<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    //
    function scopeActive($query)
    {
        return $query->where('stats', 'active');
    }

    protected $guarded = [];

    function product()
    {
        return $this->belongsTo(Product::class);
    }
}
