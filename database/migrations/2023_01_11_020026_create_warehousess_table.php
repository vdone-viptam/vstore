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
        Schema::create('warehousess', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Tên kho hàng');
            $table->string('phone_number')->comment('Số điện thoại kho hàng');
            $table->string('address')->comment('Địa chỉ chính xác kho hàng');
            $table->integer('user_id')->comment('Id user sở hữu kho hàng');
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
        Schema::dropIfExists('warehousess');
    }
};
