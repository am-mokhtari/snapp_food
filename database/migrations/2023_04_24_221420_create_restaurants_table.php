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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->constrained(
                table: 'users', indexName: 'restaurants_user_id'
            )->cascadeOnDelete();
            $table->foreignId('type_id')->nullable()->constrained(
                table: 'restaurant_types', indexName: 'restaurants_type_id'
            )->nullOnDelete();
            $table->string('phone_number');
            $table->text('address');
            $table->string('account_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
