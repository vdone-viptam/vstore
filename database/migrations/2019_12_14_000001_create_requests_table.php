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
            $table->integer('role')->default(0);
            $table->integer('prepay')->default(0);
            $table->integer('payment_on_delivery')->default(0);
            $table->longText('images')->nullable();
            $table->integer('status')->default(0);
            $table->integer('user_id');
            $table->integer('vstore_id')->nullable();
            $table->double('discount_vshop');
            $table->string('note')->nullable();
            $table->string('code');
            $table->float('vat',20,2);
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
