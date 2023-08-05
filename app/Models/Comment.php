<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
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

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
