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
        Schema::create('pre_order_vshop', function (Blueprint $table) {
            $table->id();

            $table->integer("user_id");
            $table->integer("district_id");
            $table->integer("province_id");
            $table->integer("ware_id");
            $table->integer("product_id");

            $table->integer("status")->default(2); // 1 thành công, 2 chờ xét duyệt
            $table->integer("payment_status")->default(2); // 1 đã thanh toán, 2 chưa thanh toán
            $table->integer("payment_deposit_money_status")->default(2); // 1 đã thanh toán, 2 chưa thanh toán
            $table->integer("quantity");
            $table->string("place_name");
            $table->string("fullname");
            $table->string("phone");
            $table->string("address");
            $table->string("no");

            $table->decimal("total", 11, 3);
            $table->decimal("discount", 11, 3);
            $table->decimal("deposit_money", 11, 3);

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
        Schema::dropIfExists('pre_order_vshop');
    }
};
