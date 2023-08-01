<?php

namespace Database\Seeders;


use App\Models\Address;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Comment;
use App\Models\DiscountCode;
use App\Models\Food;
use App\Models\FoodCategory;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\RestaurantType;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//      users:
        \App\Models\User::factory(10)->create();

//      restaurant_types
        RestaurantType::factory(4)->create();

//      restaurants
        Restaurant::factory(6)->create();

//      food_categories
        FoodCategory::factory(5)->create();

//      foods
        Food::factory(15)->create();

//      addresses
        Address::factory(14)->create();

//      discount_codes
        DiscountCode::factory(3)->create();

//      carts
        Cart::factory(4)->create();

//      cart_items
        CartItem::factory(10)->create();

//      orders
        Order::factory(3)->create();

//      transactions
        Transaction::factory(4)->create();

//      comments
        Comment::factory(12)->create();
    }
}
