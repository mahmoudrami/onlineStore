<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    protected $guarded = [];


    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function role_permission()
    {
        return $this->hasMany(rolePermission::class);
    }
}
