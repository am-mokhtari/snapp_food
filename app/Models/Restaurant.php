<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type_id',
        'phone_number',
        'address',
        'account_number',
    ];

    public function foods(): HasMany
    {
        return $this->hasMany(Food::class);
    }
}
