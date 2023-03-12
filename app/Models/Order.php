<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "payment_status",
        "district_id",
        "province_id",
        "pay",
        "method_payment",
        "status",
        "no",
        "shipping",
        "total",
        "fullname",
        "phone",
        "address",
    ];
    protected $table = 'order';
}
