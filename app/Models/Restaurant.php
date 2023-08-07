<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'type_id',
        'phone_number',
        'account_number',
        'score',
        'is_open',
        'address_id ',
    ];

    protected $hidden = [
        'user_id',
        'type_id',
        'address_id',
    ];

    public function foods(): HasMany
    {
        return $this->hasMany(Food::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function type(): belongsTo
    {
        return $this->belongsTo(RestaurantType::class);
    }

    protected function phoneNumber(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => '0' . $value,
        );
    }

    public function comments()
    {
        $orders = $this->orders;
        if (is_null($orders)) {
            return null;
        }

        $ids = [];
        foreach ($orders as $order) {
            $ids[] = $order->id;
        }

        $comments = Comment::whereIn('order_id', $ids)->get();
        if (empty($comments->all())) {
            return null;
        }
        return $comments;
    }
}
