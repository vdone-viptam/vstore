<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Warehouses()
    {
        return $this->hasMany(Warehouses::class, 'user_id')->paginate(4);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'user_id');
    }

    public function vstoreProducts()
    {
        return $this->hasMany(Product::class, 'vstore_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'provinceId', 'province_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'district_id');
    }
    public function ward()
    {
        return $this->belongsTo(Ward::class, 'ward_id', 'wards_id');
    }
}
