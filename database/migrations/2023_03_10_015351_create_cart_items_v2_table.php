<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items_v2', function (Blueprint $table) {
            $table->id();

            $table->integer('product_id');
            $table->integer('cart_id');
            $table->integer('vshop_id');
            $table->string('sku')->nullable();
            $table->decimal('price', 11, 3);
            $table->integer('quantity');
            $table->integer('discount_ncc');
            $table->integer('discount_vstore');
            $table->integer('discount_vshop');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_items_v2');
    }
};
