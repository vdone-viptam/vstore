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
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('bank_id');
            $table->double('amount', 20, 2)->default(0);
            $table->integer('status')->default(0);
            $table->string('account_number');
            $table->string('code');
            $table->integer('user_id');
            $table->double('old_money', 20, 2)->default(0);
            $table->integer('type')->default(1);
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
        Schema::dropIfExists('deposits');
    }
};
