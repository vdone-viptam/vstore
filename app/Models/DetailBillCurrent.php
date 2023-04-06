<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBillCurrent extends Model
{
    use HasFactory;
    protected $table = 'detail_bill_current';
    protected $fillable= ['id', 'bill_current_id', 'product_id', 'amount','price','status'];
}
