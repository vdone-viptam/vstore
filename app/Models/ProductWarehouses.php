<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductWarehouses extends Model
{
    use HasFactory;

    protected $table = 'product_warehouses';
    protected $fillable = [
        'product_id',
        'ware_id',
        'amount',
        'status'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
