<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_product', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('publish_id')->nullable();
            $table->string('vshop_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->float('price',20,2)->nullable();
            $table->integer('bill_detail_id')->nullable();
            $table->integer('vstore_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('status')->default(0);
            $table->integer('bill_id')->default(0);
            $table->float('weight')->default(0);
            $table->integer('ware_id')->default(0);
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
        Schema::dropIfExists('bill_product');
    }
};
