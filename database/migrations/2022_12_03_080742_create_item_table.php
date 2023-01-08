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
        Schema::create('item', function (Blueprint $table) {
            $table->comment('');
            $table->bigIncrements('id');
            $table->integer('cuisine_id');
            $table->integer('subcuisine_id')->comment('subcuisine id from subcuisines table');
            $table->string('item_name');
            $table->string('weather_id');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->integer('item_type')->comment('1=veg,2=nonveg');
            $table->integer('has_variation')->comment('1=yes,2=no');
            $table->string('attribute')->nullable();
            $table->string('price', 11)->nullable()->default('0');
            $table->string('addons_id')->nullable();
            $table->longText('item_description')->nullable();
            $table->string('preparation_time')->default('0')->comment('In minutes');
            $table->string('tax');
            $table->integer('item_status')->default(1)->comment('1 = Yes , 2 = No');
            $table->integer('is_featured')->nullable()->default(2)->comment('1=yes,2=no');
            $table->integer('is_deleted')->default(2)->comment('1 = Yes , 2 = No');
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
        Schema::dropIfExists('item');
    }
};
