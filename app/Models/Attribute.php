<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    //
    use SoftDeletes, Translatable;

    public $translatedAttributes = ['name'];
    function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }
    // public function translations()
    // {
    //     return $this->hasMany(AttributeTranslation::class);
    // }

    protected $guarded = [];
}
