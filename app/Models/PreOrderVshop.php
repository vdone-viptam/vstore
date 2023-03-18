<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\CollectionModify;

class PreOrderVshop extends Model
{
    use HasFactory;

    protected $table = "pre_order_vshop";
    protected $fillable = [
        "user_id",
        "district_id",
        "province_id",
        "ward_id",
        "product_id",
        "status",
        "payment_status",
        "payment_deposit_money_status",
        "quantity",
        "place_name",
        "fullname",
        "phone",
        "address",
        "discount",
        "deposit_money",
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouses::class, 'ware_id');
    }
}
