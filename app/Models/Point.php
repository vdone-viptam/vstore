<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;
    protected $table='points';
    protected $fillable = [
        "customer_id",
        "product_id",
        "point_evaluation",
        "order_item_id",
        "descriptions",
        "images",
    ];
    public function pointRep()
    {
        return $this->hasOne(PointRep::class, 'point_id');
    }
    protected function images(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value),
        );
    }
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date('d-m-Y H:i:s', strtotime($value)),
        );

    }
    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date('d-m-Y H:i:s', strtotime($value)),
        );
    }
}
