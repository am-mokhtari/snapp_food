<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RestaurantResource;
use App\Models\Address;
use App\Models\Restaurant;
use App\Models\RestaurantType;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            "is_open" => 'boolean',
            "type" => 'alpha|min:1|max:100',
            "score_gt" => 'boolean',
        ]);

        $restaurants = Restaurant::with('address')->with('type')->whereHas('address');

        if ($request->is_open) {
            $restaurants = $restaurants->where('is_open', true);
        }
        if ($request->score_gt) {
            $restaurants = $restaurants->orderBy('score', 'desc');
        }
        if (isset($request->type)) {
            $type = RestaurantType::where("title", 'like', '%'.$request->type.'%')->get();
            $restaurants = $restaurants->where('type_id', $type[0]->id);
        }

        return RestaurantResource::collection($restaurants->get());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $restaurant_id)
    {
        $restaurant = Restaurant::find($restaurant_id);
        return RestaurantResource::make($restaurant);
    }

}
