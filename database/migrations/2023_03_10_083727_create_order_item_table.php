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
        Schema::create('order_item', function (Blueprint $table) {
            $table->id();

            $table->integer('order_id');
            $table->integer('product_id');
            $table->integer('vshop_id');
            $table->string('sku')->nullable();
            $table->decimal('price', 11, 3);
            $table->integer('quantity');
            $table->integer('status')->default(0);
            $table->integer('warehouse_id');
            $table->integer('discount');
            $table->float('discount_vshop',8,2);
            $table->float('discount_ncc',8,2);
            $table->float('discount_vstore',8,2);
            $table->integer('ncc_id')->default(0);

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
        Schema::dropIfExists('order_item');
    }
};
