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
            if (Auth::guard('supplier')->check())
                return $query->where('supplier_id', Auth::guard('supplier')->user()->id);
            else
                return $query;
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

    function reviews()
    {
        return $this->hasMany(Review::class);
    }

    function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class, 'product_attribute_values');
    }

    function getSoldAttribute()
    {
        return OrderDetails::where('product_id', $this->id)->sum('quantity');
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

    function getCountRateAttribute()
    {
        return Review::where('product_id', $this->id)->count();
    }

    function getTodayDiscount()
    {
        $day = now()->day; // 1 إلى 31

        // مثال: خصم بسيط حسب رقم اليوم
        $discountPercent = $day % 5 + 1; // سيعطي خصومات 1% إلى 5% متغيرة يومياً

        return ($discountPercent / 100) * $this->price;
    }
}
