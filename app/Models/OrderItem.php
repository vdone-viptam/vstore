<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'vshop_id',
        'sku',
        'discount',
        'price',
        'quantity',
    ];
    protected $table = 'order_item';

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function vshop()
    {
        return $this->belongsTo(Vshop::class, 'vshop_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouses::class, 'warehouse_id');
    }

}
