<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    //
    use SoftDeletes, Translatable;

    protected $guarded = [];
    public $translatedAttributes = ['name', 'description'];


    function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function getImgPathAttribute()
    {
        return asset('images/services/' . $this->icon);
    }
}
