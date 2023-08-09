<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Number;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartsResource;
use App\Http\Resources\OrderResource;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Food;
use App\Models\Order;
use App\Notifications\CartCreated;
use App\Notifications\CartPaid;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(): JsonResponse
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


    public function store(Request $request): JsonResponse
    {
        $cart = Auth::user()->lastCart()->first();
        if (is_null($cart)) {
            $cart = Cart::create([
                'user_id' => Auth::id(),
                'is_closed' => false,
            ]);

            Auth::user()->notify(new CartCreated($cart->id));
        }

        $cartItem = $cart->items->where('food_id', '=', $request['food_id'])->first();
        if (!is_null($cartItem)) {
            $data = ['food_id' => $request['food_id'], 'count' => $request['count']];
            $request = Request::create('', '', $data);
            return $this->update($request);
        }

        CartItem::create(
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


    public function show(Cart $cart_id): JsonResponse
    {
        $cart = Cart::find($cart_id);
        if (is_null($cart)) {
            return response()->json(['msg' => 'The Cart does not exists.']);

        } elseif ($cart->user_id != Auth::id()) {
            return response()->json(['msg' => 'This cart is not for you!']);
        }

        $list['cart'] = $cart;
        foreach ($cart->foods as $food) {
            $food->restaurant;
        }

        return response()->json(["Carts" => CartsResource::make($list['cart'])]);
    }


    public function update(Request $request): JsonResponse
    {
        $cart = Auth::user()->lastCart()->first();
        $cartItem = $cart->items()->where('food_id', '=', $request['food_id'])->first();
        $cartItem->number = $request['count'];
        $cartItem->save();

        return response()->json([
            "msg" => "food numbers updated.",
            "Cart_id" => $cart->id
        ]);
    }


    public function pay(string $cart_id): JsonResponse
    {
        $cart = Cart::find($cart_id);

        if (is_null($cart)) {
            return response()->json(['msg' => 'The Cart does not exists.']);

        } elseif ($cart->user_id != Auth::id()) {
            return response()->json(['msg' => 'This cart is not for you!']);
        } elseif ($cart->is_closed) {
            return response()->json(['msg' => 'This cart has been paid!']);
        }

        $items = $cart->items;
        if (is_null($items)) {
            return response()->json(['msg' => 'Your cart is empty.']);
        }

        $cartAmount = 0;
        $restaurantsAmounts = [];
        foreach ($items as $item) {
            $amount = $item->number * Food::find($item->food_id)->price;

            if (isset($restaurantsAmounts[$item->restaurant()->id])) {
                $restaurantsAmounts[$item->restaurant()->id] += $amount;
            } else {
                $restaurantsAmounts[$item->restaurant()->id] = $amount;
            }

            $cartAmount += $amount;
        }

        $cart->discountCode()->first() ? $percents = $cart->discountCode()->first()->percents : $percents = 0;
        $payingAmount = $cartAmount - round($cartAmount * ($percents / 100), -2);

        $restaurants = $cart->restaurants();
        foreach ($restaurants as $restaurant) {
            $orders[] = Order::create([
                'user_id' => Auth::id(),
                'cart_id' => $cart->id,
                'restaurant_id' => $restaurant->id,
                'amount' => $restaurantsAmounts[$restaurant->id],
                'order_status' => 'pending',
                'payment_status' => 'paid',
                'tracking_code' => '',
            ]);
        }

        $cart->is_closed = true;
        $cart->save();

        Auth::user()->notify(new CartPaid($cart->id, $cartAmount, $payingAmount, $orders));

        return response()->json([
            "msg" => "Your cart with id: " . $cart->id . " is paid.",
            "cart amount" => Number::doReadable($cartAmount),
            "paid amount" => Number::doReadable($payingAmount),
            "discount amount" => Number::doReadable($cartAmount - $payingAmount),
            "orders" => OrderResource::collection($orders),
        ]);
    }
}
