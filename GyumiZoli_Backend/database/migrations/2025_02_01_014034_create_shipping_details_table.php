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
        Schema::create('shipping_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->string('customers_name');
            $table->string('customers_phone');
            $table->date('shipping_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('shipping_address');
            $table->enum('payment__method', ['c.o.d','shop']);
            $table->enum('status', ['pending', 'processing','shipped', 'delivered', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_details');
    }
};
