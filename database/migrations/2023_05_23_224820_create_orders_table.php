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
            $table->unsignedBigInteger('user_id');
            $table->string('order_number', 10)->unique();
            $table->unsignedBigInteger('product_id');
            $table->float('sum_total')->default(0);
            $table->float('total_amount')->default(0);
            $table->float('coupon')->default(0)->nullable();
            $table->string('payment_method')->default('cod');
            $table->enum('payment_status', ['paid', 'unpaid'])->default('unpaid');
            $table->enum('condition', ['pending', 'processing', 'delivered', 'caneclled'])->default('pending');
            $table->float('delivery_charge')->default(0)->nullable();
            $table->integer('quantity')->default(0);

            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('country');
            $table->string('street');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->integer('postcode');
            $table->mediumText('note');

            $table->string('shipping_first_name');
            $table->string('shipping_last_name');
            $table->string('shipping_email')->unique();
            $table->string('shipping_phone');
            $table->string('shipping_country');
            $table->string('shipping_street');
            $table->string('shipping_address');
            $table->string('shipping_city');
            $table->string('shipping_state');
            $table->integer('shipping_postcode');
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
