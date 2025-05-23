<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    //
    use SoftDeletes;

    protected $guarded = [];


    function imageable()
    {
        return $this->morphTo();
    }


    function getImageAttribute()
    {
        if ($this->image) {
            return asset('backend/images/products' . $this->image);
        }
    }
}
