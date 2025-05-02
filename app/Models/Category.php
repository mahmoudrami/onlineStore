<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    //
    use SoftDeletes;

    // function products()
    // {
    //     return $this->hasMany(Product::class)->default();
    // }

    protected $guarded = [];

    function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
