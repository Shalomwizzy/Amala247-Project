<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('guest_id');
            $table->unsignedBigInteger('user_address_id')->nullable();
            $table->boolean('is_read')->default(false);
            $table->string('order_id')->unique();
            $table->double('total');
            $table->enum('order_status', ['added', 'placed', 'order placed',  'canceled', 'dispatched', 'delivered'])->default('order placed');
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
}



