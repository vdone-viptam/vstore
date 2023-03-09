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
        Schema::create('bill_more_discount', function (Blueprint $table) {
            $table->id();
            $table->string('pdone_id')->default(0);
            $table->integer('start')->default(0);
            $table->integer('end')->default(0);
            $table->float('discount', 11, 2);
            $table->integer('product_id')->default(0);
            $table->float('deposit_money',20,2)->comment('tiền cọc khi nhập sẵn');
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
        Schema::dropIfExists('bill_more_discount');
    }
};
