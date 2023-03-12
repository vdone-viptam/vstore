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
        Schema::create('order', function (Blueprint $table) {
            $table->id();

            $table->integer('district_id')->comment('ID này nhận bên vận chuyển');
            $table->integer('province_id')->comment('ID này nhận bên vận chuyển');
            $table->integer('status')->comment('Trạng thái');
            $table->boolean('pay')->comment('Trạng thái có thể thanh toán');
            $table->integer('shipping')->comment('Phí ship');
            $table->string('method_payment')->unique()->comment('cách thức thanh toán');
            $table->string('no')->unique()->comment('Mã hoá đơn');
            $table->string('shipping_details')->comment('Chi tiết thông tin vận chuyển, mảng');
            $table->decimal('total', 11, 3)->comment('Tổng tiền');
            $table->string('fullname');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address');

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
        Schema::dropIfExists('order');
    }
};
