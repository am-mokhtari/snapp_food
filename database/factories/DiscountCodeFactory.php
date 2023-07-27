<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DiscountCode>
 */
class DiscountCodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->unique()->regexify('[A-Z]{5}[0-9]{3}'),
            'percents' => fake()->numberBetween(5, 80),
            'expiration_date' => fake()->dateTimeBetween('-1 week', '+40 days')->format('Y-m-d'),
            'expiration_time' => fake()->dateTimeBetween('-1 week', '+40 days')->format('H:i:s'),
        ];
    }
}
