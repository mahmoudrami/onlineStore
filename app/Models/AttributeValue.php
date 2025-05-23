<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttributeValue extends Model
{
    //
    use SoftDeletes, Translatable;

    public $translatedAttributes = ['value'];

    function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    protected $guarded = [];
}
