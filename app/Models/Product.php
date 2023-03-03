<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function vStore()
    {
        return $this->belongsTo(User::class, 'vstore_id');
    }

    public function NCC()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class, 'product_id');
    }

}
