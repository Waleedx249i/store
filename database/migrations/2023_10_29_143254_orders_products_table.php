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

        Schema::create('orders_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity')->default(1);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders_products');
    }
};
