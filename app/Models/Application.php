<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $table = 'requests';


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
