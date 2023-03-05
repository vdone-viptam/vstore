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
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('Tên kho hàng');
            $table->string('phone_number')->nullable()->comment('Số điện thoại kho hàng');
            $table->string('address')->nullable()->comment('Địa chỉ chính xác kho hàng');
            $table->integer('user_id')->nullable()->comment('Id user sở hữu kho hàng');
            $table->string('city_id')->nullable();
            $table->string('district_id')->nullable();
            $table->string('ward_id')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
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
