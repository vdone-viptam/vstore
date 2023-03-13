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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->string('phone_number')->nullable();
            $table->float('total',20,2)->nullable();
            $table->string('specific_address')->nullable();
            $table->string('pdone_id')->nullable();
            $table->string('address')->nullable();
            $table->integer('bill_payment_status')->default(config('constants.billPaymentStatus.unpaid'));
            $table->string('method_payment')->nullable();
            $table->integer('user_confirm')->default(2);
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
        Schema::dropIfExists('bills');
    }
};
