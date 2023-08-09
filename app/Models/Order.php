<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    protected function trackingCode(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => fake()->unique()->numerify('O-##########'),
        );
    }

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function foods()
    {
        return $this->cart()->first()->foods()->where('restaurant_id', '=', $this->restaurant_id)->get();
    }
}
