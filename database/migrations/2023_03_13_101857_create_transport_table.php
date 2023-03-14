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
        Schema::create('transport', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->default(100)->comment('Theo Bảng danh sách trạng thái trong docs vận chuyển');
            $table->integer('order_id');
            $table->string('delivery_time');
            $table->string('order_service')->default('VCN');
            $table->integer('sender_district');
            $table->integer('sender_province');
            $table->integer('receiver_district');
            $table->integer('receiver_province');
            $table->integer('product_weight');
            $table->decimal('transport_fee', 11, 3);
            $table->decimal('product_price', 11, 3);
            $table->decimal('money_collection', 11, 3);

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
        Schema::dropIfExists('transport');
    }
};
