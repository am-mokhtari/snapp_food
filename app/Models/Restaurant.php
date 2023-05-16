<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'type_id',
        'phone_number',
        'address',
        'account_number',
    ];

    public function foods(): HasMany
    {
        return $this->hasMany(Food::class);
    }

    protected function phoneNumber(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => '0' . $value,
        );
    }
}
