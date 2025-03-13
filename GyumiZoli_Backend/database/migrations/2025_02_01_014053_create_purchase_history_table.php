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
        Schema::create('purchase_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('shipping_detail_id');
            $table->date('purchase_date');
            $table->integer('totalPrice');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_history');
    }
};
