<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Food extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ingredient',
        'price',
        'picture',
        'restaurant_id',
        'category_id',
        'discount_percent',
    ];

    protected $hidden = [
        'restaurant_id',
        'category_id',
    ];

    protected $table = "foods";

    public function foodCategory(): BelongsTo
    {
        return $this->belongsTo(FoodCategory::class, 'category_id');
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function carts(): BelongsToMany
    {
        return $this->belongsToMany(Cart::class, 'cart_items');
    }

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function comments()
    {
        $carts = $this->carts;
        if (is_null($carts)) {
            return null;
        }

        $orders = [];
        foreach ($carts as $cart) {
            $order = $cart->order;
            if (!is_null($order)) {
                $orders[] = $order;
            }
        }
        if (count($orders) === 0) {
            return null;
        }

        $ids = [];
        foreach ($orders as $order) {
            $ids[] = $order->id;
        }
        $comments = Comment::whereIn('order_id', $ids)->get();

        if (count($comments) === 0) {
            return null;
        }
        return $comments;
    }
}
