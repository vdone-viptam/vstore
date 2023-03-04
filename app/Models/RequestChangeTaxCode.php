<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestChangeTaxCode extends Model
{
    use HasFactory;

    protected $table = 'request_change_taxcode';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
