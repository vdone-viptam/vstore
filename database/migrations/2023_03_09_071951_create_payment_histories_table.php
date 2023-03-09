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
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->id();

            $table->decimal("amount", 11,3)->nullable();
            $table->string("amount_foreign")->nullable();
            $table->string("amount_original")->nullable();
            $table->string("amount_request")->nullable();
            $table->string("bank")->nullable();
            $table->string("card_brand")->nullable();
            $table->string("card_info")->nullable();
            $table->string("currency")->nullable();
            $table->string("description")->nullable();
            $table->string("error_code")->nullable();
            $table->string("exc_rate")->nullable();
            $table->string("failure_reason")->nullable();
            $table->string("foreign_currency")->nullable();
            $table->string("invoice_no")->unique();
            $table->string("lang")->nullable();
            $table->string("method")->nullable();
            $table->string("payment_no")->unique();
            $table->integer("status")->nullable();
            $table->string("tenor")->nullable();

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
        Schema::dropIfExists('payment_histories');
    }
};
