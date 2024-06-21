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
            $table->string('order_id');
            $table->integer('user_id');
            $table->string('address');
            $table->integer('product_id');
            $table->string('item_name');
            $table->integer('quantity');
            $table->enum('status',array('placed','confirmed','shipped','out for delivery','delivered','cancelled'));
            $table->enum('payment',array('Online Payment','COD'));
            $table->integer('amount');
            $table->string('coupon_code')->nullable();
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
