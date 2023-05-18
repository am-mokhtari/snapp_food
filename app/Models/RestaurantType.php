<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RestaurantType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['title'];

    public function restaurants(): HasMany
    {
        return $this->hasMany(Restaurant::class, 'type_id');
    }
}
