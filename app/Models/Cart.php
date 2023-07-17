<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }
}
