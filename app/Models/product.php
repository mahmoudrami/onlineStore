<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

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

    protected static function booted()
    {
        static::addGlobalScope('supplier', function ($query) {
            // هادي لو بدي اعرض كل اشي للادمن هي طريقة بس في طريقة بعملها في الكنترولر
            // withoutGlobalScopes() بلغي كل اشي انا عاملو هادي
            // withoutGlobalScope(name where define global scope) هادي بيلغي بس الي انت بتحددو
            if (Auth::guard('admin')->check()) {
                return $query;
            }

            return $query->where('supplier_id', Auth::guard('supplier')->user()->id);
        });
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

    function getSoldAttribute()
    {
        return OrderDetails::where('product_id', $this->id)->count();
    }

    function getCountWishListAttribute()
    {
        return Wishlist::where('product_id', $this->id)->count();
    }

    function getImgPathAttribute()
    {
        return asset('images/products/' . @$this->image->path);
    }

    function getRateAttribute()
    {

        $sumRate = Review::where('product_id', $this->id)->sum('rating');
        $countRate = Review::where('product_id', $this->id)->count();

        if ($countRate == 0) {
            return 0;
        }
        return ceil($sumRate / $countRate);
    }
}
