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
            $table->tinyInteger('type')->comment('1 kho thuong, 2 kho lanh, 3 kho bãi');
            $table->double('acreage',12,2)->comment('dien tich');
            $table->double('volume',12,2)->comment('the tich')->nullable();
            $table->double('length',12,2)->comment('chieu dai')->nullable();
            $table->double('width',12,2)->comment('chieu rong')->nullable();
            $table->double('height',12,2)->comment('chieu cao')->nullable();
            $table->longText('image_storage')->nullable();
            $table->longText('image_pccc')->nullable();
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
