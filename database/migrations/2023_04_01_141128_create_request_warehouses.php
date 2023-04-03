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
        Schema::create('request_warehouses', function (Blueprint $table) {
            $table->id();
            $table->integer('ncc_id')->nullable()->comment('id nhà cung cấp');
            $table->integer('product_id')->nullable()->comment('id sản phẩm');
            $table->integer('status')->nullable()->comment('trạng thái 0 chờ ,1 đồng ý, 2 từ chối');
            $table->integer('type')->nullable()->comment('1 nhập , 2 xuất');
            $table->integer('ware_id')->nullable()->comment('id kho');
            $table->integer('quantity')->nullable()->comment('số lượng sản phẩm');
            $table->string('code')->nullable()->comment('mã xuất, nhập');
            $table->integer('note')->nullable()->comment('ghi chú');
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
        Schema::dropIfExists('request_warehouses');
    }
};
