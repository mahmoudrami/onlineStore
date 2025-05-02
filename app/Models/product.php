<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    function gallery()
    {
        return $this->morphMany(Image::class, 'imageable')->where('type', 'gallery');
    }

    function image()
    {
        return $this->morphOne(Image::class, 'imageable')->where('type', 'main');
    }

    // function category()
    // {
    //     return $this->belongsTo(Category::class)->default();
    // }

    function getImgPathAttribute()
    {
        return asset('images/products/' . @$this->image->path);
    }
}