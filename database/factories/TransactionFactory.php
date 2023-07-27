<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'token' => hash('sha256', $plainTextToken = fake()->unique()->regexify('[A-Za-z]{20}')),
            'ref_num' => fake()->unique()->bothify('###-????'),
            'order_id' => Order::factory(),
            'payment_amount' => fake()->numberBetween(300000, 6000000),
            'completion_status' => Arr::random(['1', '-1', '-2', '-3', '-4', '-5', '-6', '-7', '-8', '-9', '-98', '-99']),
            'transaction_id' => fake()->randomNumber('5', true),
            'tracking_code' => fake()->randomNumber(10, true),
            'paid_card' => fake()->creditCardNumber(),
        ];
    }
}
