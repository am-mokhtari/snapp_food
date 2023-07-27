<?php

namespace Database\Factories;

use App\Models\FoodCategory;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Food>
 */
class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->title,
            'ingredient' => fake()->words(),
            'price' => fake()->numberBetween(300000, 3000000),
            'picture' => fake()->imageUrl(640, 480, 'foods', true, (fake()->word)),
            'restaurant_id' => Restaurant::factory(),
            'category_id' => FoodCategory::factory(),
            'discount_percent' => fake()->numberBetween(5, 80),
        ];
    }
}
