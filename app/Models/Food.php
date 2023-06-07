<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Food extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ingredient',
        'price',
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
}
