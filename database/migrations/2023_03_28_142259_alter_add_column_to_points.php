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
        Schema::table('points', function (Blueprint $table) {
            $table->bigInteger('order_item_id')->unsigned()->nullable()->comment('lưu id order item');
            $table->string('descriptions')->nullable();
            $table->longText('images')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0: chưa trả lời, 1: đã trả lời');
            $table->foreign('order_item_id')->references('id')->on('order_item')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('points', function (Blueprint $table) {
            $table->dropColumn('order_item_id');
            $table->dropColumn('descriptions');
            $table->dropColumn('images');
        });
    }
};
