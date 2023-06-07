<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FoodResource;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function show(string $restaurant_id)
    {
        foreach (Restaurant::find($restaurant_id)->foods as $food) {
            $foodCategories[] = $food->foodCategory;
        }
        foreach ($foodCategories as $foodCategory) {
            $categories[] = [
                'id' => $foodCategory->id,
                'title' => $foodCategory->title,
                'foods' => FoodResource::collection($foodCategory->foods)
            ];
        }

        return response()->json(['Categories' => $categories]);
    }
}
