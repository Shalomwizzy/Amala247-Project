<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('guest_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->unsignedBigInteger('guest_id');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->integer('quantity')->default(0);
            $table->enum('order_type', ['GUEST'])->default('GUEST');
            $table->integer('amount')->default(0);
            $table->decimal('takeaway_pack', 10, 2)->default(0);
            $table->decimal('delivery_fee', 10, 2)->default(0);
            $table->enum('order_status', ['added', 'placed', 'order placed',  'canceled', 'dispatched', 'delivered'])->default('order placed');
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->string('paystack_ref')->nullable();
            $table->dateTime('paystack_date')->nullable();
            $table->string('paid_amount')->nullable();
            $table->timestamps();
            
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('guest_orders');
    }
};




