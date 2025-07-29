<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    function getImgPathAttribute()
    {
        if ($this->image == 'no-image.png') {
            return asset('images/no-image.png');
        } else {
            return asset('images/users/' . $this->image);
        }
    }

    function setProviderTokenAttribute($value)
    {
        $this->attributes['provider_token'] = Crypt::encrypt($value);
    }

    function getProviderTokenAttribute($value)
    {
        return Crypt::decrypt($value);
    }

    function cart()
    {
        return $this->hasOne(Cart::class);
    }
}
