<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'is_closed'
    ];
}
