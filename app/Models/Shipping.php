<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipping extends Model
{
    //
    use SoftDeletes;

    protected $guarded = [];

    protected $fillable = ['city', 'price'];

    function scopeActive($query)
    {
        return $query->where('stats', 'active');
    }
}