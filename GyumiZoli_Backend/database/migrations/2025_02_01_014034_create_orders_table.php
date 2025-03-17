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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->integer('totalPrice');
            $table->json('items'); 
            $table->string('customers_name');
            $table->string('customers_phone');
            $table->string('delivery_date')->nullable();
            $table->string('delivery_address');
            $table->enum('payment_method', ['card','cash']);
            $table->enum('status', ['pending', 'processing','shipped', 'delivered', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
