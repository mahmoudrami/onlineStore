<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    use SoftDeletes, Translatable;

    protected $translatedAttributes = ['name', 'description'];
    protected $guarded = [];

    function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    function gallery()
    {
        return $this->morphMany(Image::class, 'imageable')->where('type', 'gallery');
    }

    function image()
    {
        return $this->morphOne(Image::class, 'imageable')->where('type', 'main');
    }

    function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class, 'product_attribute_values');
    }

    function getImgPathAttribute()
    {
        return asset('images/products/' . @$this->image->path);
    }
}
