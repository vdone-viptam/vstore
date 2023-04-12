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
        Schema::create('vshop', function (Blueprint $table) {
            $table->id();
            $table->string('pdone_id')->nullable()->comment('Id pdone');
            $table->string('name')->nullable()->comment('tên vshop');
            $table->string('name_address')->nullable()->comment('tên địa chỉ');
            $table->string('phone_number')->nullable()->comment('số điện thoại');
            $table->string('district')->nullable()->comment('quận,huyện');
            $table->integer('province')->nullable()->comment('tỉnh thành');
            $table->string('address')->nullable();
            $table->double('money', 20, 2)->default(0);
            $table->integer('products_sold')->default(0);
            $table->string('nick_name')->nullable();
            $table->integer('vshop_id')->nullable();
            $table->integer('wards')->default(0);
            $table->integer('description')->nullable();
            $table->integer('vshop_name')->nullable();
            $table->string('avatar')->nullable();
            // $table->string('avatar')->nullable();
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
        Schema::dropIfExists('vshop');
    }
};
