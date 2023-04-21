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
            $table->bigInteger('ware_id')->unsigned();
            $table->tinyInteger('type');
            $table->double('acreage',12,2);
            $table->double('length',12,2);
            $table->double('width',12,2);
            $table->double('height',12,2);
            $table->longText('images');
            $table->timestamps();
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->foreign('ware_id')->references('id')->on('warehouses')->onUpdate('cascade')->onDelete('cascade');
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
