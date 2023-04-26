<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        "id",
        "publish_id",
        "discount",
        "discount_vShop",
        "name",
        "category_id",
        "description",
        "images",
        "brand",
        "weight",
        "length",
        "height",
        "packing_type",
        "volume",
        "manufacturer_name",
        "manufacturer_address",
        "import_unit",
        "price",
        "unit",
        "min_product_sale",
        "prepay",
        "payment_on_delivery",
        "status",
        "admin_confirm_date",
        "vstore_confirm_date",
        "amount_product_sold",
        "vstore_id",
        "user_id",
        "origin",
        "with",
        "sku_id",
        "note",
        "amount_product",
        "import_date",
        "vat",
        "code",
        "unit_name",
        "unit_images",
        "video",
        "material",
        "percent_discount",
        "import_address",
        "view",
        "number",
        "deposit_money",
        "type_pay",
        "short_content",
        "availability_status",
        "created_at",
        "updated_at",

    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function vStore()
    {
        return $this->belongsTo(User::class, 'vstore_id');
    }

    public function NCC()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class, 'product_id');
    }

    public function orderitem()
    {
        return $this->belongsToMany(Order::class,'id',OrderItem::class,'order_id');
    }
   
}
