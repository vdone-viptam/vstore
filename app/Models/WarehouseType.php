<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseType extends Model
{
    use HasFactory;

    protected $table = 'warehouse_type';

    protected $fillable = [
        "id",
        "user_id",
        "type",
        "acreage",
        "volume",
        "length",
        "width",
        "height",
        "images",
    ];
}
