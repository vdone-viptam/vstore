<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartV2 extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','status'];
    protected $table = 'cart_v2';
}
