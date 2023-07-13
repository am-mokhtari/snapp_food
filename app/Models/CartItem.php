<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'food_id',
        'number',
    ];

    protected $hidden = [
        'cart_id',
        'food_id'
    ];

    public function food(): BelongsTo
    {
        return $this->belongsTo(Food::class);
    }
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

}
