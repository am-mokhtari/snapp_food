<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cart_id' => Cart::factory(),
            'user_id' => User::factory(),
            'amount' => fake()->numberBetween(300000, 6000000),
            'order_status' => Arr::random(['pending', 'preparing', 'sending', 'delivered', 'canceled']),
            'payment_status' => Arr::random(['unpaid', 'paid']),
            'tracking_code' => fake()->randomNumber(10, true), // return a number with 10Digits
            'score' => fake()->numberBetween(0, 5),
        ];
    }
}
