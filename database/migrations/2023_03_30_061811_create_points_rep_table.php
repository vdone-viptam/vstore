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
        Schema::create('points_rep', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('point_id')->unsigned()->comment('lưu id point_id');
            $table->string('descriptions');
            $table->timestamps();
            $table->foreign('point_id')->references('id')->on('points')->onDelete('cascade')->onUpdate('cascade');
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
