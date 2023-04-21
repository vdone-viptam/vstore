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
        Schema::create('warehouse_type', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->unsigned();
            $table->tinyInteger('type')->comment('1 kho lanh, 2 kho bãi, 3 kho thuong');
            $table->double('acreage',12,2)->comment('dien tich');
            $table->double('volume',12,2)->comment('the tich');
            $table->double('length',12,2)->comment('chieu dai');
            $table->double('width',12,2)->comment('chieu rong');
            $table->double('height',12,2)->comment('chieu cao');
            $table->longText('images');
            $table->timestamps();
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouse_type');
    }
};
