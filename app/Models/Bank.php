<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    //
    use SoftDeletes;


    protected $guarded = [];

    function monies()
    {
        return $this->hasMany(Money::class);
    }

    function getAmountAfterApplyPercentageAttribute()
    {
        return $this->amount - $this->amount * ($this->percentage / 100);
    }

    function getSumAttribute()
    {
        $sum = 0;
        foreach ($this->monies->pluck('amount')->toArray() as $value) {
            $sum += $value;
        }
        return $sum;
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }


    function getResidualAttribute()
    {
        return $this->amount_after_apply_percentage - $this->sum;
    }
}
