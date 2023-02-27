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
        Schema::create('product_warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->integer('ware_id');
            $table->integer('product_id');
            $table->integer('status')->comment('0 cho nhap,1 nhap,2 xuat,3 cho xuat,4 tu choi xuat');
            $table->integer('amount');
            $table->integer('bill_product_id');
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
        Schema::dropIfExists('product_warehouses');
    }
};
