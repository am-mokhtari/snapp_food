<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodCategory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['title'];

    public function foods(): HasMany
    {
        return $this->hasMany(Food::class);
    }
}
