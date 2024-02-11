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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            // $table->enum('order_type', ['user', 'guest']);
            $table->string('order_type');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('guest_id')->nullable();
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->double('amount');
            $table->string('order_status'); // New field
            $table->string('paystack_ref')->nullable(); // New field
            $table->timestamp('paystack_date')->nullable(); // New field
            $table->double('paid_amount')->nullable(); // New field
            $table->boolean('is_read')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('user_orders')->onDelete('cascade');
            $table->foreign('guest_id')->references('id')->on('guest_orders')->onDelete('cascade');
        });
    }




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};

