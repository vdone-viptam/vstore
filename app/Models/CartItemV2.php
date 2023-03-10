<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItemV2 extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'cart_id', 'vshop_id', 'sku', 'discount', 'price', 'quantity'];
    protected $table = 'cart_items_v2';
}
