<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'ref_num',
        'order_id',
        'payment_amount',
        'completion_status',
        'transaction_id',
        'tracking_code',
        'paid_card',
    ];

    protected $hidden = [
        'token',
        'order_id',
    ];
}
