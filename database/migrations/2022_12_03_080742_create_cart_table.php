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
        Schema::create('cart', function (Blueprint $table) {
            $table->comment('');
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('item_id');
            $table->string('item_name');
            $table->string('item_image');
            $table->integer('item_type')->comment('1=veg,2=nonveg');
            $table->string('addons_id')->nullable();
            $table->string('addons_name')->nullable();
            $table->string('addons_price')->nullable();
            $table->float('addons_total_price', 10, 0)->nullable()->default(0);
            $table->string('variation_id')->nullable();
            $table->string('variation')->nullable();
            $table->integer('qty');
            $table->string('item_price');
            $table->string('tax');
            $table->integer('is_available')->default(1)->comment('1 = Yes . 2 = No');
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
        Schema::dropIfExists('cart');
    }
};
