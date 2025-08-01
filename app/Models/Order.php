<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    //
    use SoftDeletes;

    protected $guarded = [];

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function items()
    {
        return $this->hasMany(OrderDetails::class);
    }

    function placeOrder()
    {
        return $this->belongsTo(PlaceOrder::class);
    }
}
