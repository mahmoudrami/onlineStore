<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    //
    use SoftDeletes;

    protected $guarded = [];
    protected $translatedAttributes = ['comment'];


    function scopeActive($query)
    {
        return $query->where('stats', 'active');
    }

    function user()
    {
        return $this->BelongsTo(User::class);
    }
}
