<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillCurrent extends Model
{
    use HasFactory;
    protected $table = 'bill_current';
    protected $fillable= ['id', 'code_bill', 'vshop_id', 'price','status'];
}
