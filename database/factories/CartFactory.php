<?php

namespace Database\Factories;

use App\Models\DiscountCode;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'discount_id' => DiscountCode::factory(),
            'is_closed' => fake()->numberBetween(0, 1),
        ];
    }
}
