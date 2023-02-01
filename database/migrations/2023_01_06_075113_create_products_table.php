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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('publish_id')->nullable()->comment('Mã sản phẩm admi cấp');
            $table->float('discount')->nullable()->comment('Phần trăm chiết khấu');
            $table->float('discount_vShop')->nullable()->comment('Phần trăm chiết khấu cho v shop');
            $table->string('name')->nullable()->comment('Tên sản phẩm');
            $table->integer('category_id')->nullable()->comment('giá vốn');
            $table->longText('description')->nullable()->comment('Mô tả sản phẩm');
            $table->longText('images')->nullable()->comment('Bộ sưu tập hình ảnh sản phẩm');
            $table->longText('brand')->nullable()->comment('Tên thương hiệu sản phẩm');
            $table->float('weight')->nullable()->comment('Trọng lượng sản phẩm');
            $table->float('length')->nullable()->comment('Chiều dài sản phẩm');
            $table->float('height')->nullable()->comment('Chiều cao sản phẩm');
            $table->integer('packing_type')->nullable()->comment('kiểu đóng gói');
            $table->integer('volume')->nullable()->comment('Số lượng sản phẩm thêm');
            $table->string('manufacturer_name')->nullable()->comment('Tên nhà sản xuất');
            $table->integer('unit')->nullable()->comment('Đơn vị sản xuất');
            $table->string('unit_name')->nullable()->comment('Tên đơn vị sẳn xuất');
            $table->longText('unit_images')->nullable()->comment('Ảnh chứng minh');
            $table->string('manufacturer_address')->nullable()->comment('Địa chỉ nhà sản xuất');
            $table->string('import_unit')->nullable()->comment('Đơn vị nhập khẩu');
            $table->string('import_address')->nullable()->comment('Địa chỉ nơi nhập khẩu');
            $table->float('price')->nullable()->comment('Giá bán sản phẩm');
            $table->integer('min_product_sale')->nullable()->comment('Số sản phẩm mua ít nhất để giảm giá');
            $table->integer('prepay')->nullable()->comment('Thanh toán trước');
            $table->integer('payment_on_delivery')->nullable()->comment('Thanh toán khi nhận hàng');
            $table->integer('status')->nullable()->comment('Trạng thái sản phẩm');
            $table->dateTime('admin_confirm_date')->nullable()->comment('Ngày admin duyệt đơn đăng ký sản phẩm');
            $table->dateTime('vstore_confirm_date')->nullable()->comment('Ngày nhà phân phối duyệt đơn đăng ký sản phẩm');
            $table->integer('amount_product_send_to_discount')->nullable()->comment('Số sản phẩm đã bán');
            $table->integer('vstore_id')->nullable()->comment('Id nhà phẩn phối');
            $table->integer('user_id')->nullable()->comment('Id sở hữu sản phẩm');
            $table->string('origin')->nullable()->comment('Xuất sứ');
            $table->float('with')->nullable()->comment('Chiều rộng');
            $table->float('percent_discount')->nullable()->comment('Số phần trăm giảm giá');
            $table->integer('sku_id')->nullable()->comment('Mã sản phẩm');
            $table->string('note')->nullable()->comment('Mã sản phẩm');
            $table->string('amount_product')->nullable()->comment('Ghi chú');
            $table->dateTime('import_date')->nullable()->comment('Ngày xuất/ nhập khảu');
            $table->string('code')->nullable();
            $table->string('video')->comment('video sản phẩm');
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
