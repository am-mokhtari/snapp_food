<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'cart_id',
        'user_id',
        'amount',
        'order_status',
        'payment_status',
        'tracking_code',
        'score',
    ];

    protected $hidden = [
        'cart_id',
        'user_id',
    ];
}
