<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use HasFactory;

    protected $table = "transport";
    protected $fillable = [
        "status",
        "order_id",
        "delivery_time",
        "order_service",
        "sender_district",
        "sender_province",
        "receiver_district",
        "receiver_province",
        "product_weight",
        "transport_fee",
        "product_price",
        "money_collection",
    ];
}
