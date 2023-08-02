<?php

namespace Database\Seeders;

use App\Models\CartItem;
use App\Models\Comment;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//      cart_items
        CartItem::factory(10)->create();

//      transactions
        Transaction::factory(4)->create();

//      comments
        Comment::factory(12)->create();
    }
}
