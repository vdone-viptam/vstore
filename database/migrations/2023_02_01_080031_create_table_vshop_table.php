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
            $table->integer('id_product')->comment('id sản phẩm');
            $table->integer('id_category')->comment('id danh mục sản phẩm');
            $table->string('id_ncc')->comment('id nhà cung cấp');
            $table->string('id_npp')->comment('id nhà phân phối');
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
