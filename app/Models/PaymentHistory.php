<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        "amount",
        "amount_foreign",
        "amount_original",
        "amount_request",
        "bank",
        "card_brand",
        "card_info",
        "currency",
        "description",
        "error_code",
        "exc_rate",
        "failure_reason",
        "foreign_currency",
        "invoice_no",
        "lang",
        "method",
        "payment_no",
        "status",
        "tenor",
    ];

    protected $table = 'payment_histories';
}
