<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Supplier extends Authenticatable
{
    //
    use SoftDeletes, Notifiable;

    protected $guarded = [];
    function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    function products()
    {
        return $this->hasMany(product::class);
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    function getImgPathAttribute()
    {
        if ($this->image == 'no-image.png') {
            return asset('images/no-image.png');
        } else {
            return asset('images/users/' . $this->image);
        }
    }
}