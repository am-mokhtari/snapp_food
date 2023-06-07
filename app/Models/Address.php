<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'address',
        'latitude',
        'longitude',
        'user_id',
        'restaurant_id',
    ];

    protected $hidden = [
        'user_id',
        'restaurant_id',
    ];
}
