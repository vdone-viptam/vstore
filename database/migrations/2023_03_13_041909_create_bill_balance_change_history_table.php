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
        Schema::create('balance_change_history', function (Blueprint $table) {
            $table->id();
            $table->integer('vshop_id')->comment('id tài khoản vshop');
            $table->integer('user_id')->comment('id tài khoản quản trị NCC,Vstore,KHO');
            $table->integer('type')->comment('1 cộng 2 trừ');
            $table->string('title')->comment('Tiều đề');
            $table->integer('status')->default(1)->comment('Trạng thái');
            $table->double('money_history')->default(0)->comment('Tổng tiền cộng hoặc trừ');
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
        Schema::dropIfExists('balance_change_history');
    }
};
