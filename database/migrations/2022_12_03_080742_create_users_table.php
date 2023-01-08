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
        Schema::create('users', function (Blueprint $table) {
            $table->comment('');
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email');
            $table->string('mobile')->nullable();
            $table->string('profile_image', 100);
            $table->string('password');
            $table->string('login_type', 10);
            $table->text('google_id')->nullable();
            $table->text('facebook_id')->nullable();
            $table->integer('role_id')->nullable()->comment('id from manage_roles table');
            $table->integer('type');
            $table->text('identity_image')->nullable();
            $table->text('identity_type')->nullable();
            $table->text('identity_number')->nullable();
            $table->longText('token');
            $table->string('wallet', 50)->nullable()->default('00');
            $table->string('referral_code', 10)->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('referral_amount')->default(0);
            $table->integer('is_available')->default(1)->comment('1 = Yes , 2 = No');
            $table->integer('is_online')->default(2)->comment('1=yes,2=no');
            $table->integer('is_notification')->nullable()->default(1)->comment('1=yes,2=no');
            $table->integer('is_mail')->nullable()->default(1)->comment('1=yes,2=no');
            $table->string('otp', 6)->nullable();
            $table->integer('is_verified')->nullable()->comment('1 = Yes , 2 = No');
            $table->text('remember_token')->nullable();
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
