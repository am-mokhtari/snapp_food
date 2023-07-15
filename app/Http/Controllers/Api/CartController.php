<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartsResource;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Cart::where('user_id', '=', Auth::id())->where('is_closed', '=', false)->get();
        $list = [];
        foreach ($carts as $cart) {
            $list[$cart->id][] = $cart;
            foreach ($cart->foods as $food) {
                $restaurantsFoods[$food->restaurant->id]["restaurant"] = $food->restaurant;
                $restaurantsFoods[$food->restaurant->id]["foods"][] = $food;
            }
            $list[$cart->id][] = $restaurantsFoods;
        }
        return response()->json(["Carts" => CartsResource::collection($list)]);
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
        //
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
