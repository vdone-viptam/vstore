<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $table = 'requests';
    protected $fillable= ['id', 'product_id', 'discount', 'role','prepay','payment_on_delivery','images','status','type_pay','user_id','vstore_id','discount_vshop','note','code','vat'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function vStore()
    {
        return $this->belongsTo(User::class, 'vstore_id');
    }

    public function NCC()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
