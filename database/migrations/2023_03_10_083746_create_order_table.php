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

            $table->integer('warehouse_id')->comment('warehouse id');
            $table->integer('user_id')->comment('ID này bên VDONE');
            $table->integer('district_id')->comment('ID này nhận bên vận chuyển');
            $table->integer('province_id')->comment('ID này nhận bên vận chuyển');
            $table->integer('ward_id')->comment('ID này nhận bên vận chuyển');
            $table->integer('status')->comment('Trạng thái');
            $table->integer('payment_status')->default(2)->comment('Trạng thái thanh toán');
            $table->boolean('pay')->comment('Trạng thái có thể thanh toán');
            $table->integer('shipping')->comment('Phí ship');
            $table->string('method_payment')->comment('cách thức thanh toán');
            $table->string('no')->unique()->comment('Mã hoá đơn');
            $table->decimal('total', 20, 3)->comment('Tổng tiền');
            $table->string('fullname');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->integer('export_status')->default(0)->comment('trạng thái xuất kho 1,xác nhận đơn ,2 xuất kho giao cho vận chuyển , 3 kho hủy,4 hoàn thành, 5 khách hàng huỷ');
            $table->integer('cancel_status')->nullable()->comment('trạng thái huỷ kho bởi khách,mac dinh null, khi khach huy cap nhat len 1, nhap kho cap nhat thanh 2');
            $table->string('note')->nullable()->comment('ghi chú khi khach hang huy (khi huy cap nhat export_status = 5 )');
            $table->string('order_number')->comment('mã giao vận');
            $table->integer('order_status')->comment('mã giao vận');
            $table->integer('is_split')->default(0)->comment('0 chưa chia tiền ,1 đã chia tiền');
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
