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
            $table->string('id_pdone')->comment('Id pdone');
            $table->string('name')->comment('tên vshop');
            $table->string('name_adress')->comment('tên địa chỉ');
            $table->string('phone_number')->comment('số điện thoại');
            $table->string('district')->comment('quận,huyện');
            $table->integer('province')->comment('tỉnh thành');
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
