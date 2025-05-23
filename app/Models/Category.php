<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Translatable;

class Category extends Model
{
    //
    use SoftDeletes, Translatable;


    // function products()
    // {
    //     return $this->hasMany(Product::class)->default();
    // }

    protected $guarded = [];
    protected $translatedAttributes = ['name'];

    function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    function products()
    {
        return $this->hasMany(Product::class);
    }

    function getImgPathAttribute()
    {
        return asset('images/categories/' . $this->image);
    }
}
