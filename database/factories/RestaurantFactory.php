<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\RestaurantType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'user_id' => User::factory(),
            'type_id' => RestaurantType::factory(),
            'phone_number' => fake()->unique()->e164PhoneNumber(),
            'account_number' => Str::remove('IR', fake()->iban('IR')),
            'score' => fake()->randomFloat('1', 0, 5),
            'is_open' => fake()->boolean,
            'address_id' => Address::factory(),
        ];
    }
}
