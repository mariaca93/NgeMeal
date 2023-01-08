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
        Schema::create('transaction', function (Blueprint $table) {
            $table->comment('');
            $table->integer('id', true);
            $table->integer('user_id');
            $table->integer('order_id')->nullable();
            $table->string('order_number', 50)->nullable();
            $table->string('amount', 20);
            $table->text('transaction_id')->nullable();
            $table->string('transaction_type')->comment('1 = order placed (using wallet)
2 = order cancel
3 = added-money-wallet-using- Razorpay
4 = added-money-wallet-using- Stripe
5 = added-money-wallet-using- Flutterwave
6 = added-money-wallet-using- Paystack
7 = Referral 
8 = Money added by Admin
9 = Money deducted by Admin');
            $table->string('username')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction');
    }
};
