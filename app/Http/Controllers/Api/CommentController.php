<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Food;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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


    public function store(Request $request)
    {
        $request->validate([
            'order_id' => ['required', 'numeric', 'exists:' . Order::class . ',id'],
            'score' => ['required', 'numeric', 'min:0', 'max:5'],
            'message' => ['required', 'min:3', 'max:2000', 'unique:'.Comment::class.',content'],
        ]);

        $order = Order::find($request['order_id']);

        if ($order->user_id != Auth::id()) {
            return response()->json(['msg' => 'This order is not yours.']);
        }

        $order->score = $request['score'];
        $order->save();

        $comment = Comment::create([
            'order_id' => $request['order_id'],
            'user_id' => Auth::id(),
            'content' => Str::of($request['message'])->trim(),
        ]);

        return response()->json(['msg' => "comment created successfully"]);
    }
}
