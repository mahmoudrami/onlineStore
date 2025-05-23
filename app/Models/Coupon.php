<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    //
    use SoftDeletes;

    function scopeActive($query){
        return $query->where('stats', 'active');
    }

    protected $guarded = [];
}
