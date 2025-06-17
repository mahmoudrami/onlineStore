<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];

    function scopeActive($query)
    {
        return $query->where('stats', 'active');
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function items()
    {
        return $this->hasMany(CartItem::class);
    }

    function product()
    {
        return $this->belongsTo(Product::class);
    }
}
