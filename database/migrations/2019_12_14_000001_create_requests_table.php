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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->double('discount');
            $table->integer('role');
            $table->integer('prepay')->nullable();
            $table->integer('payment_on_delivery')->nullable();
            $table->longText('images')->nullable();
            $table->integer('status')->default(0);
            $table->integer('user_id');
            $table->integer('vstore_id');
            $table->double('discount_vshop');
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
        Schema::dropIfExists('requests');
    }
};
