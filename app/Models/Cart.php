<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cart extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'discount_id',
        'is_closed',
    ];

    protected $hidden = [
        'user_id',
        'discount_id',
        'is_closed',
    ];

    public function foods(): BelongsToMany
    {
        return $this->belongsToMany(Food::class, 'cart_items');
    }

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function discountCode(): BelongsTo
    {
        return $this->belongsTo(DiscountCode::class, 'discount_id');
    }

    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }

    public function restaurants()
    {
        $restaurants = [];
        foreach ($this->foods()->get() as $food) {
            $restaurants[] = $food->restaurant;
        }
        return collect($restaurants)->unique();
    }
}
