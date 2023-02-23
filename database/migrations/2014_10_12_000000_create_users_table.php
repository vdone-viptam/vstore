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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('id_vdone')->nullable();
            $table->string('company_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('tax_code')->nullable();
            $table->string('address')->nullable();
            $table->string('id_vdone_diff')->nullable();
            $table->integer('status')->default(1);
            $table->dateTime('confirm_date')->nullable()->comment('Ngày tài khoản được duyệt');
            $table->string('account_code')->nullable()->comment('Mã tài khoản');
            $table->string('avatar')->nullable()->comment('Ảnh đại diện tài khoản');
            $table->string('banner')->nullable()->comment('Đường dẫn ảnh banner của tài khoản');
            $table->integer('role_id')->nullable()->comment('quyền 1 admin 2 nhà cung cấp 3 nhà phan phối(vstore),4 kho(storage) ');
            $table->string('link_website')->nullable();
            $table->string('slug')->nullable();
            $table->integer('branch')->default(0)->comment('ngành vstore, 0 thường, 1 địa phương');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
