<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'restaurant_id',
        'cart_id',
        'amount',
        'order_status',
        'payment_status',
        'tracking_code',
        'score',
    ];

    protected $hidden = [
        'user_id',
        'restaurant_id',
        'cart_id',
    ];
}
