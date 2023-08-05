<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartsResource;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Auth::user()->carts->where('is_closed', '=', false);
        $list = [];
        foreach ($carts as $cart) {
            $list[] = $cart;
            foreach ($cart->foods as $food) {
                $food->restaurant;
            }
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
        $cart = Auth::user()->lastCart()->firstOrCreate(
            [],
            ['user_id' => 3, 'is_closed' => false]
        );

        $cartItem = $cart->items->where('food_id', '=', $request['food_id'])->first();
        if (!is_null($cartItem)) {
            $data = ['food_id' => $request['food_id'], 'count' => $request['count']];
            $request = Request::create('', '', $data);
            return $this->update($request);
        }

        $cartItem = CartItem::create(
            [
                "cart_id" => $cart->id,
                "food_id" => $request['food_id'],
                "number" => $request['count'],
            ]
        );

        return response()->json([
            "msg" => "food added to cart successfully",
            "Cart_id" => $cart->id
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        $list['cart'] = $cart;
        foreach ($cart->foods as $food) {
            $food->restaurant;
        }

        return response()->json(["Carts" => CartsResource::make($list['cart'])]);
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
    public function update(Request $request)
    {
        $cart = Auth::user()->lastCart()->first();
        $cartItem = $cart->items()->get()->where('food_id', '=', $request['food_id'])->first();
        $cartItem->number = $request['count'];
        $cartItem->save();

        return response()->json([
            "msg" => "food numbers updated.",
            "Cart_id" => $cart->id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function pay(Cart $cart)
    {
        $amount = 0;
        foreach ($cart->items as $item) {
            $amount += $item->number * \App\Models\Food::find($item->food_id)->price;
        }
        $amount -= round(($amount * $cart->discountCode()->first()->percents) / 100, -2);


        $order = Order::create([
            'user_id' => Auth::id(),
            'cart_id' => $cart->id,
            'amount' => $amount,
            'order_status' => 'delivered',
            'payment_status' => 'paid',
            'tracking_code' => '',
        ]);
        $cart->is_closed = true;
        $cart->save();

        return response()->json([
            "msg" => "Your cart with id:" . $cart->id . " is paid.",
            "order info" => [
                "id:" => $order->id,
                "amount" => $order->amount,
                "status" => $order->order_status,
                "payment" => $order->payment_status,
                "tracking code" => $order->tracking_code,
            ]
        ]);
    }
}
