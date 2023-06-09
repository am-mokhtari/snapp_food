<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'is_open'
    ];

    protected $hidden = [
        'user_id',
        'type_id',
    ];

    public function foods(): HasMany
    {
        return $this->hasMany(Food::class);
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    public function type(): belongsTo
    {
        return $this->belongsTo(RestaurantType::class);
    }

    protected function phoneNumber(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => '0' . $value,
        );
    }
}
