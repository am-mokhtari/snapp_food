<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'order_id',
        'user_id',
    ];

    protected $hidden = [
        'order_id',
        'user_id',
    ];
}
