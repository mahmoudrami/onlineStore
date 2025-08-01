<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wishlist extends Model
{
    //

    function scopeActive($query)
    {
        return $query->where('stats', 'active');
    }

    protected $guarded = [];
}
