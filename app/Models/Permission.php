<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use SoftDeletes, HasFactory;
    protected $guarded = [];

    public function getChildsAttribute()
    {
        return Permission::where('parent_id', $this->id)->get();
    }
}
