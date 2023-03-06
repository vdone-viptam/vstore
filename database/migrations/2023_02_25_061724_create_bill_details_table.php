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
        Schema::create('bill_details', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->integer('bill_id')->nullable();
            $table->integer('ware_id')->nullable();
            $table->string('address')->nullable();
            $table->double('total', 20, 2);
            $table->string('pick_up_address')->nullable();
            $table->integer('district')->nullable();
            $table->integer('province')->nullable();
            $table->integer('export_status')->default(0)->comment('trạng thái xuất kho 0,1');
            $table->integer('ware_district')->nullable()->comment('địa chỉ huyện của kho');
            $table->integer('ware_province')->nullable()->comment('địa chỉ tỉnh thành của kho');
            $table->float('weight',20,2)->default(0)->comment('trọng lượng');
            $table->float('transport_fee',20,2)->default(0)->comment('phí vận chuyển');
            $table->integer('status')->default(0)->comment('trạng thái đơn hàng');
            $table->date('success_day')->nullable()->comment('ngày giao hàng thành công');
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
        Schema::dropIfExists('bill_details');
    }
};
