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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('tên sản phẩm');
            $table->integer('cate_id')->nullable()->comment('id danh mục');
            $table->string('price')->nullable()->comment('giá bán');
            $table->string('cost_price')->nullable()->comment('giá vốn');
            $table->string('barcode')->nullable()->comment('số mã vạch');
            $table->string('sku')->nullable()->comment('mã sản phẩm sku');
            $table->integer('trademark_id')->nullable()->comment('id thương hiệu');
            $table->integer('origin_id')->nullable()->comment('id xuất xứ');
            $table->integer('status')->nullable()->comment('0 hết hàng, 1 còn hàng');
            $table->text('desc');
            $table->text('photo_gallery');
            $table->integer('payment_methods')->nullable()->comment('1 thanh toán trước,2 thanh toán khi nhận, 3 cả 2');
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
        Schema::dropIfExists('products');
    }
};
