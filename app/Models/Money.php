<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Money extends Model
{
    //
    use SoftDeletes;

    function scopeActive($query)
    {
        return $query->where('stats', 'active');
    }

    protected $guarded = [];

    function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}
