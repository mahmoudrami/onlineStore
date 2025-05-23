<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    //
    use SoftDeletes, Translatable;

    function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    protected $translatedAttributes = ['name'];

    protected $guarded = [];
}
