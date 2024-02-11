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
        Schema::create('user_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->unsignedBigInteger('user_id')->nullable();
            // $table->string('guest_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->enum('order_type', ['USER'])->default('USER');
            $table->integer('quantity')->default(0);
            $table->integer('amount')->default(0);
            $table->unsignedBigInteger('user_address_id')->nullable();
            $table->enum('order_status', ['added', 'placed', 'order placed',  'canceled', 'dispatched', 'delivered'])->default('order placed');
            $table->string('paystack_ref')->nullable();
            $table->decimal('takeaway_pack', 10, 2)->default(0);
            $table->decimal('delivery_fee', 10, 2)->default(0);
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->dateTime('paystack_date')->nullable();
            $table->string('paid_amount')->nullable();
            $table->string('coupon_code')->nullable(); 
            $table->decimal('coupon_amount', 10, 2)->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');
        });
            
   
    }

   
    public function down(): void
    {
        Schema::dropIfExists('user_orders');
    }
};
