<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceTranslation extends Model
{
    //
    use SoftDeletes;

    protected $guarded = [];


    function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
