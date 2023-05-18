<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('active_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained('carts')
            ->onUpdate('NO ACTION')
            ->noActionOnDelete();
            $table->integer('amount');
            $table->enum('status', ['pending', 'preparing', 'sending', 'delivered', 'canceled']);
            $table->string('tracking_code');
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
