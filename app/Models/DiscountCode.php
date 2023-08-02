<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DiscountCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'percents',
        'expiration_date',
        'expiration_time',
    ];

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'discount_id');
    }
}
