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
        Schema::create('cuisines', function (Blueprint $table) {
            $table->comment('');
            $table->bigIncrements('id');
            $table->string('cuisine_name');
            $table->string('slug');
            $table->string('image');
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
        Schema::dropIfExists('cuisines');
    }
};
