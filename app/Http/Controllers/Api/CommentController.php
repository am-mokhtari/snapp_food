<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Food;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
//        ----------- base on food_id
        if (isset($request['food_id'])) {
            $food = Food::find($request['food_id']);
            if (is_null($food)) {
                return response()->json(['msg' => 'food_id is incorrect.']);
            }

            $comments = $food->comments();
            if (is_null($comments)) {
                return response()->json(['msg' => "the food don't have any comment."]);
            }
            return ["Comments" => CommentResource::collection($comments)];

        }
//        ----------- base on restaurant_id
        else if (isset($request['restaurant_id'])) {

            $restaurant = Restaurant::find($request['restaurant_id']);
            if (is_null($restaurant)) {
                return response()->json(['msg' => 'restaurant_id is incorrect.']);
            }

            $comments = $restaurant->comments();
            if (is_null($comments)) {
                return response()->json(['msg' => "the restaurant don't have any comment."]);
            }
            return ["Comments" => CommentResource::collection($comments)];
        }
        return response()
            ->json(['msg' => "for see comments you must enter the food_id or restaurant_id !"]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
