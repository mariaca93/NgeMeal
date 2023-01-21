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
        Schema::create('order', function (Blueprint $table) {
            $table->comment('');
            $table->bigIncrements('id');
            $table->string('order_number', 100);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('driver_id')->nullable();
            $table->string('address_type', 10)->nullable()->comment('1- Home, 2-Office, 3-Other');
            $table->string('address')->nullable();
            $table->string('house_no')->nullable();
            $table->text('area')->nullable();
            $table->text('lat')->nullable();
            $table->text('lang')->nullable();
            $table->string('delivery_charge', 50)->nullable()->default('0.00');
            $table->string('grand_total');
            $table->string('transaction_id')->nullable();
            $table->string('transaction_type')->comment('1 = cod, 2=wallet,3=razorpay,4=stripe/5=flutterwave,6=paystack');
            $table->string('status', 11)->comment('1=Order-placed(both)
2=accepted-by-admin(both)
3=order-ready(both)
4=order-on-the-way(delivery) && waiting-for-pickup(pickup)
5=order-completed(both)
6=cancelled-by-admin(both)
7=cancelled-by-user(both)');
            $table->string('order_from', 10)->nullable();
            $table->integer('is_notification')->default(1)->comment('1 = Unread , 2 = Read');
            $table->text('order_notes')->nullable();
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
        Schema::dropIfExists('order');
    }
};
