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
        Schema::create('order_service', function (Blueprint $table) {
            $table->id();

            $table->integer('user_id')->comment('ID user');
            $table->integer('status')->comment('Trạng thái');
            $table->integer('payment_status')->default(2)->comment('Trạng thái thanh toán');
            $table->string('method_payment')->comment('cách thức thanh toán');
            $table->string('no')->unique()->comment('Mã hoá đơn');
            $table->string('type')->comment('kiểu dịch vụ');
            $table->decimal('total', 20, 3)->comment('Tổng tiền');

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
        Schema::dropIfExists('order_service');
    }
};
