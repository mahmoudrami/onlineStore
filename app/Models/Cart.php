<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    //
    protected $guarded = [];

    function scopeActive($query)
    {
        return $query->where('stats', 'active');
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function items()
    {
        return $this->hasMany(CartItem::class);
    }

    function product()
    {
        return $this->belongsTo(Product::class);
    }

    function getSubTotalAttribute()
    {
        return $this->amount;
    }

    function getShippingAttribute()
    {

        return session('shippingPrice');
    }

    function getEstimatedTotalAttribute()
    {
        if ($this->sub_total > 0) {
            return $this->sub_total + $this->shipping - $this->getDiscountAttribute();
        }

        return 0;
    }

    function getTodayDiscount()
    {
        $day = now()->day; // 1 إلى 31

        // مثال: خصم بسيط حسب رقم اليوم
        $discountPercent = $day % 5 + 1; // سيعطي خصومات 1% إلى 5% متغيرة يومياً


        return $discountPercent;
    }

    function getDiscountAttribute()
    {
        return $this->getAmountAttribute() * ($this->getTodayDiscount() / 100);
    }

    function getAmountAttribute()
    {
        $sum = 0;
        $items = $this->items;

        foreach ($items as $item) {
            $sum += $item->price * $item->quantity;
        }

        return $sum;
    }
}
