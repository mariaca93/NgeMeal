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
        Schema::create('addons', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->string('name', 50);
            $table->string('measurement');
            $table->string('price', 20)->default('0');
            $table->integer('is_available')->default(1)->comment('1 = Yes , 2 = No');
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
        Schema::dropIfExists('addons');
    }
};
