<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->noActionOnDelete();
            $table->foreignId('restaurant_id')
                ->constrained('restaurants')
                ->noActionOnDelete();
            $table->foreignId('cart_id')
                ->constrained('carts')
                ->noActionOnDelete();
            $table->integer('amount');
            $table->enum('order_status', ['pending', 'preparing', 'sending', 'delivered', 'canceled'])
                ->default('pending');
            $table->enum('payment_status', ['unpaid', 'paid'])
                ->default('unpaid');
            $table->string('tracking_code');
            $table->tinyInteger('score')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
